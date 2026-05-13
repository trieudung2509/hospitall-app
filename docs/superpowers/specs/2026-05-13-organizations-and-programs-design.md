# Organizations & Programs — Design

**Date:** 2026-05-13
**Scope:** Admin-only CRUD for two new entities — Organizations (organizational units) and Programs — plus auto-provisioning of a linked `users` row when an Organization is created. Pattern modeled on the existing `Blog` / `BlogController` flow.

## Goals

- Admin can create/list/edit/soft-delete Organizations under `/admin/organizations`.
- Admin can create/list/edit/soft-delete Programs under `/admin/programs`, each tied to one Organization.
- Creating an Organization automatically creates a `users` row with `user_type='organization'` and a pivot row in `organization_users` linking them.
- Editing an Organization keeps the linked user's `name`/`email`/`phone` in sync.
- Soft-deleting an Organization cascades in one transaction: linked user soft-deleted, all programs for that org soft-deleted, and the `organization_users` pivot row hard-deleted (the pivot has no SoftDeletes).

## Non-goals (explicitly out of scope)

- Organization-user self-service login / dashboard. Auto-created users never log in.
- Restore / undelete UI for soft-deleted records.
- Translation tables for org or program names.
- Public frontend pages for organizations or programs (no `routes/web.php` entries).
- API endpoints for these entities (no `routes/api.php` entries).
- "Manage organization users" UI — in this design, each org has exactly one pivot row.
- Bulk operations on programs.
- A new service / observer / form-request layer. All side-effects live inline in the controllers, wrapped in `DB::transaction`, matching the existing house style.

## Data model

Three new tables. Models live flat under `app/` to match the existing project layout (`app/Blog.php`, `app/Page.php`, etc.).

### `organizations` (model: `App\Organization`)

| column | type | notes |
|---|---|---|
| `id` | bigIncrements | |
| `org_name` | string | required |
| `org_type` | string nullable | free text (e.g. "hospital", "clinic", "ngo") |
| `status` | tinyInteger | default 1 (acts as boolean) |
| `contact_person` | string nullable | |
| `contact_phone` | string(30) nullable | |
| `contact_email` | string | required, validated unique against `users.email` |
| `created_at`, `updated_at` | timestamps | |
| `deleted_at` | softDeletes | |

Model uses `HasFactory, SoftDeletes`. Relationships:

- `programs()` — `hasMany(Program::class, 'org_id')`
- `organizationUsers()` — `hasMany(OrganizationUser::class, 'org_id')`
- `linkedUser()` — convenience accessor returning the single linked user via the pivot. Implementation can use `hasOneThrough` if it composes cleanly with this schema, or a plain method that does `$this->organizationUsers->first()->user`. Either is fine.

### `organization_users` (model: `App\OrganizationUser`)

Snake-case table name to match Laravel conventions; user's spec used `organizationUsers`.

| column | type | notes |
|---|---|---|
| `id` | bigIncrements | added (spec omitted it; required for Eloquent) |
| `user_id` | unsignedBigInteger, FK → `users.id` | |
| `org_id` | unsignedBigInteger, FK → `organizations.id` | |
| `status` | tinyInteger | default 1 |
| `note` | string nullable | |
| `created_at`, `updated_at` | timestamps | added for auditability |

Composite unique index on `(user_id, org_id)`.

No SoftDeletes on this pivot — `destroy` hard-deletes the row.

Relationships:

- `user()` — `belongsTo(User::class)`
- `organization()` — `belongsTo(Organization::class, 'org_id')`

### `programs` (model: `App\Program`)

| column | type | notes |
|---|---|---|
| `id` | bigIncrements | |
| `org_id` | unsignedBigInteger, FK → `organizations.id` | required |
| `approved_by` | unsignedBigInteger, FK → `users.id`, nullable | auto-set to current admin on create |
| `user_id` | unsignedBigInteger, FK → `users.id` | creator (current admin) |
| `name` | string | required, max 255 |
| `description` | text(3000) nullable | |
| `banner` | integer nullable | AizUploader upload id (matches `blog.banner`) |
| `location` | string nullable | |
| `start_time` | dateTime | required |
| `end_time` | dateTime | required, must be after `start_time` |
| `max_participants` | integer nullable | |
| `reg_open_time` | dateTime nullable | |
| `reg_close_time` | dateTime nullable | must be after `reg_open_time` when both present |
| `status` | string(20) | enum-in-code: `'activated'` or `'inActived'`, default `'activated'` |
| `note` | text nullable | |
| `created_at`, `updated_at` | timestamps | |
| `deleted_at` | softDeletes | |

Model uses `HasFactory, SoftDeletes`. Relationships:

- `organization()` — `belongsTo(Organization::class, 'org_id')`
- `author()` — `belongsTo(User::class, 'user_id')`
- `approver()` — `belongsTo(User::class, 'approved_by')`

### `users` table changes

- Add `SoftDeletes` trait to `App\User` and add a `deleted_at` column via a new migration. This makes the cascade semantically correct (linked organization users are soft-deleted alongside their org).
- `user_type` is already a string column; the new value written is `'organization'`. No schema change needed for `user_type`.

The new `User` relationships added (non-breaking):

- `organizationUsers()` — `hasMany(OrganizationUser::class)`
- `organizations()` — `belongsToMany(Organization::class, 'organization_users', 'user_id', 'org_id')`

## Routes

All inside the existing `['prefix' => 'admin', 'middleware' => ['auth','admin']]` group in `routes/admin.php`. No `web.php` or `api.php` changes.

```php
// Organizations
Route::resource('organizations', 'OrganizationController');
Route::get('/organizations/destroy/{id}', 'OrganizationController@destroy')->name('organizations.destroy');
Route::post('/organizations/change-status', 'OrganizationController@change_status')->name('organizations.change-status');

// Programs
Route::resource('programs', 'ProgramController');
Route::get('/programs/destroy/{id}', 'ProgramController@destroy')->name('programs.destroy');
Route::post('/programs/change-status', 'ProgramController@change_status')->name('programs.change-status');
```

The duplicated `destroy` GET route is the project's existing convention (blog, brands, categories all do it).

## Controllers

### `app/Http/Controllers/OrganizationController.php`

- `index(Request $request)` — list with search by `org_name`, filter by `org_type`, filter by `status`. Paginate 15. View: `backend.organizations.index`.
- `create()` — view: `backend.organizations.create`.
- `store(Request $request)` — validates, then `DB::transaction` performs:
  1. `$org = Organization::create([...])`
  2. `$user = User::create(['user_type' => 'organization', 'name' => $org->org_name, 'email' => $org->contact_email, 'phone' => $org->contact_phone, 'password' => Hash::make(Str::random(32)), 'email_verified_at' => now()])`
  3. `OrganizationUser::create(['user_id' => $user->id, 'org_id' => $org->id, 'status' => 1, 'note' => null])`
  4. Flash success, redirect to `organizations.index`.
- `show($id)` — empty (blog pattern).
- `edit($id)` — view: `backend.organizations.edit`.
- `update(Request $request, $id)` — validates, then `DB::transaction` performs:
  1. `$org->update([...])`
  2. Look up `OrganizationUser` for this org. If found, update its `user` with the new `name`/`email`/`phone`.
  3. If the pivot or user is missing (data drift), log a warning and continue — do **not** silently create a replacement (edit is not a creation path).
- `destroy($id)` — `DB::transaction` cascade:
  1. `Program::where('org_id', $id)->delete()` (soft-deletes via SoftDeletes)
  2. Look up linked user_ids via `OrganizationUser::where('org_id', $id)->pluck('user_id')`
  3. `User::whereIn('id', $userIds)->delete()` (soft-deletes — see `users` table changes)
  4. `OrganizationUser::where('org_id', $id)->delete()` (hard delete; no SoftDeletes on pivot)
  5. `$org->delete()` (soft-deletes)
- `change_status(Request $request)` — toggle `status` (0/1), return `1`. Mirrors `BlogController@change_status`.

### `app/Http/Controllers/ProgramController.php`

- `index(Request $request)` — sort by `created_at` DESC. Filters: `search` (name), `org_id`, `status`. Paginate 15. View: `backend.programs.index`.
- `create()` — passes `$organizations = Organization::where('status', 1)->get()` to the form. View: `backend.programs.create`.
- `store(Request $request)` — validates, then:
  ```
  $program = new Program;
  $program->fill($validated);
  $program->user_id = Auth::id();
  $program->approved_by = Auth::id();
  $program->status = 'activated';
  $program->save();
  ```
  No transaction needed (single insert).
- `edit($id)` — view: `backend.programs.edit`. Organization dropdown lists active orgs; if the program's current org is now inactive or soft-deleted, that org is still rendered in the dropdown with an `(inactive)` suffix so the value isn't silently swapped.
- `update(Request $request, $id)` — validates, saves.
- `destroy($id)` — `$program->delete()` (soft delete only this program; no further cascade).
- `change_status(Request $request)` — flip `status` between `'activated'` and `'inActived'`, return `1`.

## Validation rules

Inline `$request->validate(...)` in controllers; no Form Request classes (matches blog).

### Organization store

```
org_name        required|string|max:255
org_type        nullable|string|max:255
contact_person  nullable|string|max:255
contact_phone   nullable|string|max:30
contact_email   required|email|unique:users,email
status          nullable|boolean
```

### Organization update

Same as store, except:

```
contact_email   required|email|unique:users,email,{$linkedUserId}
```

(`{$linkedUserId}` resolved from the pivot inside `update()`.)

### Program store / update

```
org_id            required|integer|exists:organizations,id
name              required|string|max:255
description       nullable|string|max:3000
banner            nullable|integer
location          nullable|string|max:255
start_time        required|date
end_time          required|date|after:start_time
max_participants  nullable|integer|min:0
reg_open_time     nullable|date
reg_close_time    nullable|date|after:reg_open_time
note              nullable|string
```

`status`, `user_id`, `approved_by` are not user-supplied on store — they're set by the controller.

## Views

All under `resources/views/backend/`. Each folder mirrors the `backend/blog_system/blog/` layout.

### `backend/organizations/`

- `index.blade.php` — table: ID, Org Name, Type, Contact Person, Contact Email, Status toggle, Created, Actions (Edit / Delete). Top: search input, type filter, status filter, submitted via GET.
- `create.blade.php` — form fields: `org_name`, `org_type`, `contact_person`, `contact_phone`, `contact_email`, `status` toggle (default on). Help text under `contact_email`: "A user account (user_type=organization) will be created with this email."
- `edit.blade.php` — pre-filled form. Read-only line showing "Linked user: #{user_id}" so the admin sees that edits will sync.

### `backend/programs/`

- `index.blade.php` — table: ID, Banner thumb, Name, Organization, Start Time, End Time, Status toggle (activated/inActived), Created, Actions. Filters: search by name, org dropdown, status dropdown.
- `create.blade.php` — form fields: `org_id` (select from active orgs), `name`, `banner` (AizUploader picker), `description` (rich-text editor — same component blog uses), `location`, `start_time`, `end_time`, `reg_open_time`, `reg_close_time`, `max_participants`, `note`.
- `edit.blade.php` — pre-filled. Dropdown includes the program's current org even if inactive, labeled `(inactive)`.

### Shared

- AizUploader picker partial (existing `data-toggle="aiz-uploader"` markup) for the `banner` field.
- Existing backend datetime picker component for the time fields.
- Existing rich-text editor for `description`.
- No new CSS/JS files.
- All UI strings wrapped in `translate(...)`; flash via `flash(translate('...'))->success()` / `->error()`.

### Sidebar

Add two links to the admin sidebar partial (will locate during implementation — likely `resources/views/backend/inc/`):

- "Organizations" → `route('organizations.index')`
- "Programs" → `route('programs.index')`

Active-route highlighting via the existing `areActiveRoutes(['organizations.*'])` helper.

## Side-effect flow summary

```
Create Org
  DB::transaction
    INSERT organizations
    INSERT users (user_type='organization', mirrored fields)
    INSERT organization_users

Edit Org
  DB::transaction
    UPDATE organizations
    UPDATE users (sync name/email/phone for the linked user)

Delete Org (soft)
  DB::transaction
    UPDATE programs            SET deleted_at = NOW() WHERE org_id = ?
    UPDATE users               SET deleted_at = NOW() WHERE id IN (pivot lookup)
    DELETE FROM organization_users WHERE org_id = ?
    UPDATE organizations       SET deleted_at = NOW() WHERE id = ?
```

## Migrations needed (in order)

1. `add_soft_deletes_to_users_table` — adds `deleted_at` to `users`.
2. `create_organizations_table`.
3. `create_organization_users_table`.
4. `create_programs_table`.

## Testing

This codebase ships only stub `ExampleTest.php` files and has no real test coverage. Consistent with the existing repo, no automated tests will be added unless requested. Manual verification loop:

- `php artisan migrate` runs cleanly on a fresh DB.
- Create an organization → confirm rows in `organizations`, `users` (`user_type='organization'`, `deleted_at=null`), `organization_users`.
- Edit the organization's email → linked user's email updates in the same transaction.
- Try to create a second org with the same email → validation rejects it.
- Soft-delete the org → all four tables show the cascade.
- Create a program tied to the org → after the cascade above, the program shows soft-deleted.
- Toggle program status via the row toggle → row updates without page reload.

## Risks / open notes

- Adding `SoftDeletes` to `User` adds a global scope that excludes soft-deleted users from default queries throughout the app. This is generally the desired semantic (deleted users shouldn't appear in admin user lists, blog authors, etc.) but is a behavioral change worth flagging — anywhere existing code relies on listing every user including deleted ones will silently filter them. A quick grep for `User::` queries during implementation will surface any callsites that need `withTrashed()`.
- The `organization_users` pivot is overkill for a one-to-one relationship as currently used, but matches the user's provided schema and leaves room for later multi-user-per-org features.
