@extends('frontend.layouts.app')

@section('meta_title')
    {{ get_setting('meta_title').' | '.get_setting('site_motto') }}
@endsection

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $post->meta_title }}">
    <meta itemprop="description" content="{{ $post->meta_description }}">
    <meta itemprop="image" content="{{ $post->meta_img != null ? uploaded_asset($post->meta_img) : uploaded_asset($post->banner) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $post->meta_title }}">
    <meta name="twitter:description" content="{{ $post->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ $post->meta_img != null ? uploaded_asset($post->meta_img) : uploaded_asset($post->banner) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $post->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('detail_page', ['slug' => $post->slug]) }}" />
    <meta property="og:image" content="{{ $post->meta_img != null ? uploaded_asset($post->meta_img) : uploaded_asset($post->banner) }}" />
    <meta property="og:description" content="{{ $post->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('canonical') {{ url('') }} @endsection
 
@section('content')
<main class="l-main">
          <div class="l-header__container-wrapper">
            <div class="l-header__container">
              <h1 class="headline-2 letters js-wordsplit text-center">{{ $post->title }}</h1>
            </div>
          </div>
          <article class="container">
            <div class="container-medium outline">
              <div class="container-super-narrow content mt-30em mb-20em">
                  {!! $post->description !!}
              </div>
            </div>
          </article>
        </main>
@endsection