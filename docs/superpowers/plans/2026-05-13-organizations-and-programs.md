# Organizations & Programs Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build admin-only CRUD for Organizations and Programs, with auto-provisioned organization-type users, contact-field sync on edit, and soft-delete cascade — modeled on the existing Blog flow.

**Architecture:** Three new tables (`organizations`, `organization_users`, `programs`) and a `deleted_at` column added to `users`. Two new controllers (`OrganizationController`, `ProgramController`) in the existing admin route group. All side-effects (auto-user creation, sync, cascade) live inline in the controllers, wrapped in `DB::transaction`. Three models live flat under `app/` matching the project's pre-Laravel-8 layout.

**Tech Stack:** Laravel 8 (PHP 7.3+/8.0+), MySQL, Eloquent + `SoftDeletes` trait, Blade views, existing `aiz-uploader` partial for image uploads, existing `aiz-date-range` / `aiz-selectpicker` for form inputs, `laracasts/flash` for flash messages, `translate()` helper for i18n strings.

**Reference spec:** `docs/superpowers/specs/2026-05-13-organizations-and-programs-design.md`

**Important context for the implementer:**
- This codebase has **no real test coverage** (only `ExampleTest.php` stubs). The spec explicitly opts out of adding tests. Each task ends with a **manual verification** step, not a test run.
- Models live **flat under `app/`** (e.g., `app/Blog.php`, not `app/Models/Blog.php`). Follow this.
- The `web` middleware group has `EncryptCookies` commented out — leave it alone.
- All UI strings must be wrapped in `translate('...')`. Flash messages use `flash(translate('...'))->success()` / `->error()`.
- The blog flow (`app/Http/Controllers/BlogController.php`, `resources/views/backend/blog_system/blog/`) is the canonical pattern to mirror. Read it before writing any code.

---

## File Structure

**Created:**

- `database/migrations/2026_05_13_000001_add_soft_deletes_to_users_table.php` — add `deleted_at` to `users`.
- `database/migrations/2026_05_13_000002_create_organizations_table.php`
- `database/migrations/2026_05_13_000003_create_organization_users_table.php` — pivot.
- `database/migrations/2026_05_13_000004_create_programs_table.php`
- `app/Organization.php` — Eloquent model.
- `app/OrganizationUser.php` — pivot model.
- `app/Program.php` — Eloquent model.
- `app/Http/Controllers/OrganizationController.php`
- `app/Http/Controllers/ProgramController.php`
- `resources/views/backend/organizations/index.blade.php`
- `resources/views/backend/organizations/create.blade.php`
- `resources/views/backend/organizations/edit.blade.php`
- `resources/views/backend/programs/index.blade.php`
- `resources/views/backend/programs/create.blade.php`
- `resources/views/backend/programs/edit.blade.php`

**Modified:**

- `app/User.php` — add `SoftDeletes` trait + two relations.
- `routes/admin.php` — register routes for both resources.
- `resources/views/backend/inc/admin_sidenav.blade.php` — add a sidebar group for Organizations & Programs.

---

## Task 1: Add `deleted_at` to the `users` table

**Files:**
- Create: `database/migrations/2026_05_13_000001_add_soft_deletes_to_users_table.php`
- Modify: `app/User.php`

- [ ] **Step 1: Write the migration**

Create `database/migrations/2026_05_13_000001_add_soft_deletes_to_users_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
```

- [ ] **Step 2: Add `SoftDeletes` trait to `App\User`**

Modify `app/User.php`. At the top, add the use statement next to the existing ones:

```php
use Illuminate\Database\Eloquent\SoftDeletes;
```

Change the trait line from:

```php
use Notifiable, HasApiTokens;
```

to:

```php
use Notifiable, HasApiTokens, SoftDeletes;
```

Do not change anything else in `User.php` yet — relations get added in Task 3.

- [ ] **Step 3: Run the migration**

Run: `php artisan migrate`
Expected: a single line confirming `AddSoftDeletesToUsersTable` ran. No errors.

- [ ] **Step 4: Verify column exists**

Run: `php artisan tinker --execute="echo Schema::hasColumn('users','deleted_at') ? 'yes' : 'no';"`
Expected: `yes`

- [ ] **Step 5: Smoke-test login still works**

Manually: open the app, log in as the existing admin. Expected: login succeeds, no 500. SoftDeletes only adds a global scope that filters `deleted_at IS NOT NULL`; no existing user has that set yet, so behavior is unchanged.

- [ ] **Step 6: Commit**

```bash
git add database/migrations/2026_05_13_000001_add_soft_deletes_to_users_table.php app/User.php
git commit -m "feat: add SoftDeletes to users table and model"
```

---

## Task 2: Create `organizations` table and `Organization` model

**Files:**
- Create: `database/migrations/2026_05_13_000002_create_organizations_table.php`
- Create: `app/Organization.php`

- [ ] **Step 1: Write the migration**

Create `database/migrations/2026_05_13_000002_create_organizations_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_name');
            $table->string('org_type')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('contact_person')->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->string('contact_email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
```

- [ ] **Step 2: Write the model**

Create `app/Organization.php`:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'org_name', 'org_type', 'status', 'contact_person', 'contact_phone', 'contact_email',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'org_id');
    }

    public function organizationUsers()
    {
        return $this->hasMany(OrganizationUser::class, 'org_id');
    }

    // Convenience: returns the single linked user via the pivot, or null.
    public function linkedUser()
    {
        $pivot = $this->organizationUsers()->first();
        return $pivot ? $pivot->user : null;
    }
}
```

Note: `Program::class` and `OrganizationUser::class` don't exist yet. PHP only resolves them when the methods are called, so the file will load fine. Both classes are created in Tasks 3 and 4.

- [ ] **Step 3: Run the migration**

Run: `php artisan migrate`
Expected: `CreateOrganizationsTable` ran. No errors.

- [ ] **Step 4: Verify table exists**

Run: `php artisan tinker --execute="echo Schema::hasTable('organizations') ? 'yes' : 'no';"`
Expected: `yes`

- [ ] **Step 5: Commit**

```bash
git add database/migrations/2026_05_13_000002_create_organizations_table.php app/Organization.php
git commit -m "feat: add organizations table and model"
```

---

## Task 3: Create `organization_users` pivot, model, and User relations

**Files:**
- Create: `database/migrations/2026_05_13_000003_create_organization_users_table.php`
- Create: `app/OrganizationUser.php`
- Modify: `app/User.php`

- [ ] **Step 1: Write the migration**

Create `database/migrations/2026_05_13_000003_create_organization_users_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationUsersTable extends Migration
{
    public function up()
    {
        Schema::create('organization_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('org_id');
            $table->tinyInteger('status')->default(1);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('org_id')->references('id')->on('organizations');
            $table->unique(['user_id', 'org_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_users');
    }
}
```

- [ ] **Step 2: Write the pivot model**

Create `app/OrganizationUser.php`:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationUser extends Model
{
    use HasFactory;

    protected $table = 'organization_users';

    protected $fillable = [
        'user_id', 'org_id', 'status', 'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
}
```

(No SoftDeletes on the pivot — it's hard-deleted on cascade. See spec §"Side-effect flow summary".)

- [ ] **Step 3: Add relations to `App\User`**

Modify `app/User.php`. Append two methods just before the final closing brace of the class (after the existing `product_bids()` method):

```php
    public function organizationUsers()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_users', 'user_id', 'org_id');
    }
```

- [ ] **Step 4: Run the migration**

Run: `php artisan migrate`
Expected: `CreateOrganizationUsersTable` ran.

- [ ] **Step 5: Verify table exists**

Run: `php artisan tinker --execute="echo Schema::hasTable('organization_users') ? 'yes' : 'no';"`
Expected: `yes`

- [ ] **Step 6: Commit**

```bash
git add database/migrations/2026_05_13_000003_create_organization_users_table.php app/OrganizationUser.php app/User.php
git commit -m "feat: add organization_users pivot and user relations"
```

---

## Task 4: Create `programs` table and `Program` model

**Files:**
- Create: `database/migrations/2026_05_13_000004_create_programs_table.php`
- Create: `app/Program.php`

- [ ] **Step 1: Write the migration**

Create `database/migrations/2026_05_13_000004_create_programs_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('banner')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('max_participants')->nullable();
            $table->dateTime('reg_open_time')->nullable();
            $table->dateTime('reg_close_time')->nullable();
            $table->string('status', 20)->default('activated');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('org_id')->references('id')->on('organizations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
```

- [ ] **Step 2: Write the model**

Create `app/Program.php`:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'org_id', 'approved_by', 'user_id', 'name', 'description', 'banner',
        'location', 'start_time', 'end_time', 'max_participants',
        'reg_open_time', 'reg_close_time', 'status', 'note',
    ];

    protected $casts = [
        'start_time'      => 'datetime',
        'end_time'        => 'datetime',
        'reg_open_time'   => 'datetime',
        'reg_close_time'  => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
```

- [ ] **Step 3: Run the migration**

Run: `php artisan migrate`
Expected: `CreateProgramsTable` ran. No errors.

- [ ] **Step 4: Verify table exists**

Run: `php artisan tinker --execute="echo Schema::hasTable('programs') ? 'yes' : 'no';"`
Expected: `yes`

- [ ] **Step 5: Commit**

```bash
git add database/migrations/2026_05_13_000004_create_programs_table.php app/Program.php
git commit -m "feat: add programs table and model"
```

---

## Task 5: Register routes in the admin route group

**Files:**
- Modify: `routes/admin.php`

- [ ] **Step 1: Locate the admin route group**

Open `routes/admin.php`. Find the block `Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {` (around line 19). All new routes go **inside** this `function() { ... }` body.

- [ ] **Step 2: Add the route block**

Inside the admin group, after the existing `Route::resource('blog', 'BlogController');` line and before the closing `});` of the group, paste:

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

- [ ] **Step 3: Verify routes register (controllers don't exist yet, so we only list, not hit)**

Run: `php artisan route:list --name=organizations 2>&1 | head -20`
Expected: at least 8 lines listing `organizations.index`, `organizations.create`, `organizations.store`, `organizations.show`, `organizations.update`, `organizations.edit`, `organizations.destroy`, `organizations.change-status`.

Run: `php artisan route:list --name=programs 2>&1 | head -20`
Expected: same 8 routes for `programs.*`.

Don't worry about a "controller does not exist" warning here — that's expected, it goes away in the next task.

- [ ] **Step 4: Commit**

```bash
git add routes/admin.php
git commit -m "feat: register admin routes for organizations and programs"
```

---

## Task 6: Implement `OrganizationController`

**Files:**
- Create: `app/Http/Controllers/OrganizationController.php`

- [ ] **Step 1: Write the controller**

Create `app/Http/Controllers/OrganizationController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Organization;
use App\OrganizationUser;
use App\Program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_type   = null;
        $sort_status = null;

        $organizations = Organization::orderBy('created_at', 'desc');

        if ($request->search != null) {
            $organizations = $organizations->where('org_name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        if ($request->org_type != null && $request->org_type !== '') {
            $organizations = $organizations->where('org_type', $request->org_type);
            $sort_type = $request->org_type;
        }

        if ($request->status !== null && $request->status !== '') {
            $organizations = $organizations->where('status', (int) $request->status);
            $sort_status = $request->status;
        }

        $organizations = $organizations->paginate(15);

        return view('backend.organizations.index', compact('organizations', 'sort_search', 'sort_type', 'sort_status'));
    }

    public function create()
    {
        return view('backend.organizations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'org_name'       => 'required|string|max:255',
            'org_type'       => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone'  => 'nullable|string|max:30',
            'contact_email'  => 'required|email|unique:users,email',
            'status'         => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($validated) {
            $org = Organization::create([
                'org_name'       => $validated['org_name'],
                'org_type'       => $validated['org_type'] ?? null,
                'contact_person' => $validated['contact_person'] ?? null,
                'contact_phone'  => $validated['contact_phone'] ?? null,
                'contact_email'  => $validated['contact_email'],
                'status'         => $validated['status'] ?? 1,
            ]);

            $user = User::create([
                'user_type'         => 'organization',
                'name'              => $org->org_name,
                'email'             => $org->contact_email,
                'phone'             => $org->contact_phone,
                'password'          => Hash::make(Str::random(32)),
                'email_verified_at' => now(),
            ]);

            OrganizationUser::create([
                'user_id' => $user->id,
                'org_id'  => $org->id,
                'status'  => 1,
                'note'    => null,
            ]);
        });

        flash(translate('Organization has been created successfully'))->success();
        return redirect()->route('organizations.index');
    }

    public function show($id)
    {
        // unused; blog pattern leaves this empty
    }

    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        return view('backend.organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $organization = Organization::findOrFail($id);
        $pivot        = OrganizationUser::where('org_id', $organization->id)->first();
        $linkedUserId = $pivot ? $pivot->user_id : null;

        $validated = $request->validate([
            'org_name'       => 'required|string|max:255',
            'org_type'       => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone'  => 'nullable|string|max:30',
            'contact_email'  => 'required|email|unique:users,email,'.($linkedUserId ?: 'NULL'),
            'status'         => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($organization, $pivot, $validated) {
            $organization->update([
                'org_name'       => $validated['org_name'],
                'org_type'       => $validated['org_type'] ?? null,
                'contact_person' => $validated['contact_person'] ?? null,
                'contact_phone'  => $validated['contact_phone'] ?? null,
                'contact_email'  => $validated['contact_email'],
                'status'         => $validated['status'] ?? $organization->status,
            ]);

            if ($pivot && $pivot->user) {
                $pivot->user->update([
                    'name'  => $organization->org_name,
                    'email' => $organization->contact_email,
                    'phone' => $organization->contact_phone,
                ]);
            } else {
                Log::warning('Organization '.$organization->id.' has no linked user during update; skipping user sync.');
            }
        });

        flash(translate('Organization has been updated successfully'))->success();
        return redirect()->route('organizations.index');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $organization = Organization::findOrFail($id);

            Program::where('org_id', $organization->id)->delete();

            $userIds = OrganizationUser::where('org_id', $organization->id)->pluck('user_id');
            User::whereIn('id', $userIds)->delete();

            OrganizationUser::where('org_id', $organization->id)->delete();

            $organization->delete();
        });

        flash(translate('Organization has been deleted successfully'))->success();
        return redirect()->route('organizations.index');
    }

    public function change_status(Request $request)
    {
        $organization = Organization::findOrFail($request->id);
        $organization->status = (int) $request->status;
        $organization->save();
        return 1;
    }
}
```

- [ ] **Step 2: Verify the controller class loads**

Run: `php artisan route:list --name=organizations 2>&1 | head -10`
Expected: routes listed cleanly, no "Target class does not exist" warning.

- [ ] **Step 3: Commit**

```bash
git add app/Http/Controllers/OrganizationController.php
git commit -m "feat: add OrganizationController with cascade and user sync"
```

---

## Task 7: Implement `ProgramController`

**Files:**
- Create: `app/Http/Controllers/ProgramController.php`

- [ ] **Step 1: Write the controller**

Create `app/Http/Controllers/ProgramController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Organization;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_org    = null;
        $sort_status = null;

        $programs = Program::orderBy('created_at', 'desc');

        if ($request->search != null) {
            $programs = $programs->where('name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        if ($request->org_id != null && $request->org_id !== '') {
            $programs = $programs->where('org_id', (int) $request->org_id);
            $sort_org = $request->org_id;
        }

        if ($request->status != null && $request->status !== '') {
            $programs = $programs->where('status', $request->status);
            $sort_status = $request->status;
        }

        $organizations = Organization::orderBy('org_name')->get();
        $programs      = $programs->paginate(15);

        return view('backend.programs.index', compact('programs', 'organizations', 'sort_search', 'sort_org', 'sort_status'));
    }

    public function create()
    {
        $organizations = Organization::where('status', 1)->orderBy('org_name')->get();
        return view('backend.programs.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'org_id'           => 'required|integer|exists:organizations,id',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string|max:3000',
            'banner'           => 'nullable|integer',
            'location'         => 'nullable|string|max:255',
            'start_time'       => 'required|date',
            'end_time'         => 'required|date|after:start_time',
            'max_participants' => 'nullable|integer|min:0',
            'reg_open_time'    => 'nullable|date',
            'reg_close_time'   => 'nullable|date|after:reg_open_time',
            'note'             => 'nullable|string',
        ]);

        $program = new Program;
        $program->fill($validated);
        $program->user_id     = Auth::id();
        $program->approved_by = Auth::id();
        $program->status      = 'activated';
        $program->save();

        flash(translate('Program has been created successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function show($id)
    {
        // unused
    }

    public function edit($id)
    {
        $program       = Program::findOrFail($id);
        $organizations = Organization::where('status', 1)->orderBy('org_name')->get();

        // Ensure the program's current org appears in the dropdown even if it's now inactive
        // or soft-deleted, so the value isn't silently swapped.
        if (!$organizations->contains('id', $program->org_id)) {
            $current = Organization::withTrashed()->find($program->org_id);
            if ($current) {
                $organizations = $organizations->prepend($current);
            }
        }

        return view('backend.programs.edit', compact('program', 'organizations'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $validated = $request->validate([
            'org_id'           => 'required|integer|exists:organizations,id',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string|max:3000',
            'banner'           => 'nullable|integer',
            'location'         => 'nullable|string|max:255',
            'start_time'       => 'required|date',
            'end_time'         => 'required|date|after:start_time',
            'max_participants' => 'nullable|integer|min:0',
            'reg_open_time'    => 'nullable|date',
            'reg_close_time'   => 'nullable|date|after:reg_open_time',
            'note'             => 'nullable|string',
        ]);

        $program->fill($validated);
        $program->save();

        flash(translate('Program has been updated successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function destroy($id)
    {
        Program::findOrFail($id)->delete();
        flash(translate('Program has been deleted successfully'))->success();
        return redirect()->route('programs.index');
    }

    public function change_status(Request $request)
    {
        $program = Program::findOrFail($request->id);
        // The toggle posts 0/1; map to the string enum stored in the column.
        $program->status = ((int) $request->status === 1) ? 'activated' : 'inActived';
        $program->save();
        return 1;
    }
}
```

- [ ] **Step 2: Verify the controller class loads**

Run: `php artisan route:list --name=programs 2>&1 | head -10`
Expected: routes listed cleanly, no "Target class does not exist" warning.

- [ ] **Step 3: Commit**

```bash
git add app/Http/Controllers/ProgramController.php
git commit -m "feat: add ProgramController"
```

---

## Task 8: Build the Organizations admin views

**Files:**
- Create: `resources/views/backend/organizations/index.blade.php`
- Create: `resources/views/backend/organizations/create.blade.php`
- Create: `resources/views/backend/organizations/edit.blade.php`

- [ ] **Step 1: Write `index.blade.php`**

Create `resources/views/backend/organizations/index.blade.php`:

```blade
@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{ translate('All Organizations') }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('organizations.create') }}" class="btn btn-circle btn-info">
                <span>{{ translate('Add New Organization') }}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="filter_organizations" method="GET">
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="search" placeholder="{{ translate('Search by name') }}"
                        @isset($sort_search) value="{{ $sort_search }}" @endisset>
                    <input type="text" class="form-control" name="org_type" placeholder="{{ translate('Type') }}"
                        @isset($sort_type) value="{{ $sort_type }}" @endisset>
                </div>
                <div class="col-md-6">
                    <select class="form-control aiz-selectpicker" name="status">
                        <option value="">{{ translate('All statuses') }}</option>
                        <option value="1" @if ($sort_status === "1") selected @endif>{{ translate('Active') }}</option>
                        <option value="0" @if ($sort_status === "0") selected @endif>{{ translate('Inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="offset-md-5 mb-0">
                <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                <a href="{{ route('organizations.index') }}" class="btn btn-outline-info">{{ translate('Clear') }}</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-md-0 h6">{{ translate('All organizations') }}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('ID') }}</th>
                    <th>{{ translate('Name') }}</th>
                    <th>{{ translate('Type') }}</th>
                    <th>{{ translate('Contact person') }}</th>
                    <th>{{ translate('Email') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th>{{ translate('Created') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $key => $org)
                <tr>
                    <td>{{ ($key+1) + ($organizations->currentPage() - 1) * $organizations->perPage() }}</td>
                    <td>{{ $org->id }}</td>
                    <td>{{ $org->org_name }}</td>
                    <td>{{ $org->org_type ?? '--' }}</td>
                    <td>{{ $org->contact_person ?? '--' }}</td>
                    <td>{{ $org->contact_email }}</td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_status(this)"
                                value="{{ $org->id }}" <?php if ($org->status == 1) echo "checked"; ?>>
                            <span></span>
                        </label>
                    </td>
                    <td>{{ $org->created_at }}</td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('organizations.edit', $org->id) }}" title="{{ translate('Edit') }}">
                            <i class="las la-pen"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('organizations.destroy', $org->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $organizations->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function change_status(el) {
        var status = el.checked ? 1 : 0;
        $.post('{{ route('organizations.change-status') }}', { _token: '{{ csrf_token() }}', id: el.value, status: status }, function (data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '{{ translate('Organization status updated') }}');
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        });
    }
</script>
@endsection
```

- [ ] **Step 2: Write `create.blade.php`**

Create `resources/views/backend/organizations/create.blade.php`:

```blade
@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Organization Information') }}</h5>
                <a href="{{ route('organizations.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to organizations') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('organizations.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Organization name') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="org_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Type') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="org_type" class="form-control" placeholder="{{ translate('e.g. hospital, clinic, ngo') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact person') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_person" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact phone') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_phone" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact email') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="email" name="contact_email" class="form-control" required>
                            <small class="form-text text-muted">{{ translate('A user account (user_type=organization) will be created with this email.') }}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Status') }}</label>
                        <div class="col-md-9">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="status" value="1" checked>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        <a href="{{ route('organizations.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
```

- [ ] **Step 3: Write `edit.blade.php`**

Create `resources/views/backend/organizations/edit.blade.php`:

```blade
@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Edit Organization') }}</h5>
                <a href="{{ route('organizations.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to organizations') }}</span>
                </a>
            </div>
            <div class="card-body">
                @php
                    $linkedUser = $organization->linkedUser();
                @endphp
                @if($linkedUser)
                    <p class="text-muted small">{{ translate('Linked user') }}: #{{ $linkedUser->id }} ({{ $linkedUser->email }}). {{ translate('Editing name/email/phone will sync to this user.') }}</p>
                @else
                    <p class="text-warning small">{{ translate('No linked user found for this organization. User sync will be skipped.') }}</p>
                @endif

                <form class="form-horizontal" action="{{ route('organizations.update', $organization->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Organization name') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="org_name" class="form-control" value="{{ $organization->org_name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Type') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="org_type" class="form-control" value="{{ $organization->org_type }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact person') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_person" class="form-control" value="{{ $organization->contact_person }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact phone') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_phone" class="form-control" value="{{ $organization->contact_phone }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact email') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="email" name="contact_email" class="form-control" value="{{ $organization->contact_email }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Status') }}</label>
                        <div class="col-md-9">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="status" value="1" @if ($organization->status == 1) checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        <a href="{{ route('organizations.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
```

- [ ] **Step 4: Smoke-test the page renders**

Manually: log in as admin, visit `/admin/organizations`. Expected: empty table renders, no PHP errors. Click "Add New Organization", confirm the form renders.

- [ ] **Step 5: Commit**

```bash
git add resources/views/backend/organizations/
git commit -m "feat: add organizations admin views"
```

---

## Task 9: Build the Programs admin views

**Files:**
- Create: `resources/views/backend/programs/index.blade.php`
- Create: `resources/views/backend/programs/create.blade.php`
- Create: `resources/views/backend/programs/edit.blade.php`

- [ ] **Step 1: Write `index.blade.php`**

Create `resources/views/backend/programs/index.blade.php`:

```blade
@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{ translate('All Programs') }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('programs.create') }}" class="btn btn-circle btn-info">
                <span>{{ translate('Add New Program') }}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="filter_programs" method="GET">
            <div class="form-group row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="{{ translate('Search by name') }}"
                        @isset($sort_search) value="{{ $sort_search }}" @endisset>
                </div>
                <div class="col-md-4">
                    <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true">
                        <option value="">{{ translate('All organizations') }}</option>
                        @foreach ($organizations as $o)
                            <option value="{{ $o->id }}" @if ($sort_org == $o->id) selected @endif>{{ $o->org_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control aiz-selectpicker" name="status">
                        <option value="">{{ translate('All statuses') }}</option>
                        <option value="activated" @if ($sort_status === "activated") selected @endif>{{ translate('Activated') }}</option>
                        <option value="inActived" @if ($sort_status === "inActived") selected @endif>{{ translate('Inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="offset-md-5 mb-0">
                <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Clear') }}</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-md-0 h6">{{ translate('All programs') }}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('ID') }}</th>
                    <th>{{ translate('Banner') }}</th>
                    <th>{{ translate('Name') }}</th>
                    <th>{{ translate('Organization') }}</th>
                    <th>{{ translate('Start') }}</th>
                    <th>{{ translate('End') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $key => $program)
                <tr>
                    <td>{{ ($key+1) + ($programs->currentPage() - 1) * $programs->perPage() }}</td>
                    <td>{{ $program->id }}</td>
                    <td>
                        @if($program->banner)
                            <img src="{{ uploaded_asset($program->banner) }}" alt="" style="height: 40px; width: 60px; object-fit: cover;">
                        @else
                            --
                        @endif
                    </td>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->organization ? $program->organization->org_name : '--' }}</td>
                    <td>{{ $program->start_time }}</td>
                    <td>{{ $program->end_time }}</td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_status(this)"
                                value="{{ $program->id }}" <?php if ($program->status === 'activated') echo "checked"; ?>>
                            <span></span>
                        </label>
                    </td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('programs.edit', $program->id) }}" title="{{ translate('Edit') }}">
                            <i class="las la-pen"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('programs.destroy', $program->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $programs->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function change_status(el) {
        var status = el.checked ? 1 : 0;
        $.post('{{ route('programs.change-status') }}', { _token: '{{ csrf_token() }}', id: el.value, status: status }, function (data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '{{ translate('Program status updated') }}');
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        });
    }
</script>
@endsection
```

- [ ] **Step 2: Write `create.blade.php`**

Create `resources/views/backend/programs/create.blade.php`:

```blade
@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Program Information') }}</h5>
                <a href="{{ route('programs.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to programs') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('programs.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Organization') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true" required>
                                <option value="">--</option>
                                @foreach ($organizations as $o)
                                    <option value="{{ $o->id }}">{{ $o->org_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Name') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Banner') }} <small>(1300x650)</small></label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Description') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="description" data-format="true"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Location') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="location" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Start time') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('End time') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="end_time" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Registration opens') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="reg_open_time" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Registration closes') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="reg_close_time" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Max participants') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="max_participants" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Note') }}</label>
                        <div class="col-md-10">
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
```

- [ ] **Step 3: Write `edit.blade.php`**

Create `resources/views/backend/programs/edit.blade.php`:

```blade
@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Edit Program') }}</h5>
                <a href="{{ route('programs.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to programs') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('programs.update', $program->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Organization') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true" required>
                                @foreach ($organizations as $o)
                                    <option value="{{ $o->id }}"
                                        @if ($o->id == $program->org_id) selected @endif>
                                        {{ $o->org_name }}@if ($o->status != 1 || $o->trashed()) ({{ translate('inactive') }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Name') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="{{ $program->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Banner') }}</label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-selected="{{ $program->banner }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" value="{{ $program->banner }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Description') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="description" data-format="true">{{ $program->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Location') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="location" class="form-control" value="{{ $program->location }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Start time') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="start_time" class="form-control" value="{{ $program->start_time ? $program->start_time->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('End time') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="end_time" class="form-control" value="{{ $program->end_time ? $program->end_time->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Registration opens') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="reg_open_time" class="form-control" value="{{ $program->reg_open_time ? $program->reg_open_time->format('Y-m-d\TH:i') : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Registration closes') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="reg_close_time" class="form-control" value="{{ $program->reg_close_time ? $program->reg_close_time->format('Y-m-d\TH:i') : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Max participants') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="max_participants" class="form-control" value="{{ $program->max_participants }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Note') }}</label>
                        <div class="col-md-10">
                            <textarea name="note" class="form-control" rows="3">{{ $program->note }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
```

- [ ] **Step 4: Smoke-test the pages render**

Manually: visit `/admin/programs`. Expected: empty list renders. Click "Add New Program", confirm the form renders and the Organization dropdown is populated (will be empty until Task 11 verification, that's fine).

- [ ] **Step 5: Commit**

```bash
git add resources/views/backend/programs/
git commit -m "feat: add programs admin views"
```

---

## Task 10: Add the sidebar entries

**Files:**
- Modify: `resources/views/backend/inc/admin_sidenav.blade.php`

- [ ] **Step 1: Locate the Blog System sidebar block**

Open `resources/views/backend/inc/admin_sidenav.blade.php`. Find the comment `<!--Blog System-->` (around line 39) and the corresponding `</li>` + `@endif` (around lines 58–59) that close that block.

- [ ] **Step 2: Insert the new sidebar group immediately after the Blog System block**

Right after the `@endif` that closes the Blog System block, paste:

```blade
            @if(Auth::user()->user_type == 'admin')
            <!-- Organizations & Programs -->
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link">
                    <i class="las la-hospital aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Organizations') }}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('organizations.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['organizations.index', 'organizations.create', 'organizations.edit']) }}">
                            <span class="aiz-side-nav-text">{{ translate('All Organizations') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('programs.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['programs.index', 'programs.create', 'programs.edit']) }}">
                            <span class="aiz-side-nav-text">{{ translate('Programs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
```

This `@if` guards on `user_type == 'admin'` directly — the Blog System block also checks staff permission slot `23`, but since this feature is new there's no permission slot allocated, so it's admin-only for now. (Easy to add a permission slot later if needed.)

- [ ] **Step 3: Smoke-test sidebar renders**

Manually: log in as admin, refresh any admin page. Expected: a new "Organizations" group appears in the left sidebar with "All Organizations" and "Programs" links. Clicking each navigates to the right page.

- [ ] **Step 4: Commit**

```bash
git add resources/views/backend/inc/admin_sidenav.blade.php
git commit -m "feat: add organizations and programs to admin sidebar"
```

---

## Task 11: End-to-end manual verification

**Files:** none modified — this is the verification loop from the spec's *Testing* section.

- [ ] **Step 1: Clean DB state check**

Run: `php artisan migrate:status | tail -10`
Expected: the four new migrations (`add_soft_deletes_to_users_table`, `create_organizations_table`, `create_organization_users_table`, `create_programs_table`) all show `Ran`.

- [ ] **Step 2: Create an organization**

Manually: visit `/admin/organizations/create`. Fill in:
- Organization name: `Acme Hospital`
- Type: `hospital`
- Contact person: `Jane Doe`
- Contact phone: `+1 555 0100`
- Contact email: `acme@example.com`
- Status: on

Submit.

Expected: redirect to `/admin/organizations` with a success flash, and a row appears in the table.

Verify the cascade rows exist:

```bash
php artisan tinker --execute='echo App\Organization::where("contact_email","acme@example.com")->count() . "/" . App\User::where("email","acme@example.com")->count() . "/" . App\OrganizationUser::where("org_id", App\Organization::where("contact_email","acme@example.com")->first()->id)->count();'
```

Expected: `1/1/1`.

Verify the user is the right type:

```bash
php artisan tinker --execute='echo App\User::where("email","acme@example.com")->first()->user_type;'
```

Expected: `organization`.

- [ ] **Step 3: Duplicate email is rejected**

Manually: try creating a second organization with the same `contact_email`. Expected: form validation rejects with "The contact email has already been taken." No new rows.

- [ ] **Step 4: Edit org syncs the linked user**

Manually: edit the Acme Hospital org. Change email to `acme2@example.com` and name to `Acme General Hospital`. Save.

Verify:

```bash
php artisan tinker --execute='$u = App\User::where("email","acme2@example.com")->first(); echo $u ? $u->name : "missing";'
```

Expected: `Acme General Hospital`.

- [ ] **Step 5: Create a program tied to that org**

Manually: visit `/admin/programs/create`. Pick `Acme General Hospital` from the dropdown. Fill name, start_time, end_time. Save.

Verify:

```bash
php artisan tinker --execute='echo App\Program::count();'
```

Expected: `1`.

- [ ] **Step 6: Soft-delete the org → cascade**

Manually: from `/admin/organizations`, delete Acme General Hospital.

Verify each table soft-deleted (or hard-deleted for the pivot):

```bash
php artisan tinker --execute='
$org = App\Organization::withTrashed()->where("contact_email","acme2@example.com")->first();
echo "org.deleted_at=" . ($org->deleted_at ?: "null") . PHP_EOL;
$u = App\User::withTrashed()->where("email","acme2@example.com")->first();
echo "user.deleted_at=" . ($u->deleted_at ?: "null") . PHP_EOL;
echo "pivot_rows=" . App\OrganizationUser::where("org_id",$org->id)->count() . PHP_EOL;
$p = App\Program::withTrashed()->where("org_id",$org->id)->first();
echo "program.deleted_at=" . ($p->deleted_at ?: "null") . PHP_EOL;
'
```

Expected:
- `org.deleted_at=` <timestamp>
- `user.deleted_at=` <timestamp>
- `pivot_rows=0`
- `program.deleted_at=` <timestamp>

- [ ] **Step 7: Status toggles work**

Manually:
- Create a new org and a new program tied to it.
- Toggle the org's status switch on the index page → notify banner appears, row's status updates without page reload.
- Toggle the program's status switch → same.

Verify the program's status value cycles between `'activated'` and `'inActived'`:

```bash
php artisan tinker --execute='echo App\Program::orderBy("id","desc")->first()->status;'
```

- [ ] **Step 8: Final commit (only if any docs were updated in this pass)**

If steps revealed copy-tweaks or doc fixes you made along the way, commit them. Otherwise skip.

---

## Self-review checklist (already run by author)

Spec coverage verified against each section of `docs/superpowers/specs/2026-05-13-organizations-and-programs-design.md`:

- Data model — Tasks 1–4 (✓ four tables, model classes, SoftDeletes on User)
- Routes — Task 5 (✓ inside admin group, mirrors blog conventions)
- Controllers — Tasks 6–7 (✓ all six methods + change_status + DB::transactions + sync + cascade)
- Validation — embedded in Tasks 6–7 (✓ all rules from spec)
- Views — Tasks 8–9 (✓ index/create/edit for both, AizUploader for banner)
- Sidebar — Task 10 (✓)
- Testing (manual loop) — Task 11 (✓ all bullets from spec's Testing section)
- Risks/notes — n/a (informational only)

No placeholders, no "TBD"s, every code step contains complete code. Method names consistent across tasks (`change_status`, `linkedUser`). Migration filenames are in dependency order (users → organizations → pivot → programs).
