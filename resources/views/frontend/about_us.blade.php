@extends('frontend.layouts.app')

@section('meta_title')
    {{ get_setting('meta_title').' | '.get_setting('site_motto') }}
@endsection

@section('canonical') {{ url('') }} @endsection

@section('content')
    <main class="l-main">
          <div class="l-header__container-wrapper">
            <div class="l-header__container">
              <h1 class="headline-2 letters js-wordsplit text-center">{{ $title ?: '' }}</h1>
            </div>
          </div>
        <section class="section container-medium bg-image bg-image--laptop-pos-top ">
        <div class="bg-media bg-media--image bg-image lazy" id="background-image-d3CPGLlTFS" data-name="background-image-d3CPGLlTFS" data-style="    @media screen and (max-width:499px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=499&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:500px) and (max-width:500px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=500&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:501px) and (max-width:641px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=641&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:642px) and (max-width:769px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=769&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:770px) and (max-width:902px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=902&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:903px) and (max-width:1025px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=1025&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:1026px) and (max-width:1200px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=1200&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:1201px) and (max-width:1582px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=1582&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:1583px) and (max-width:1920px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=1920&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:1921px) {  #background-image-d3CPGLlTFS {  background-image: url('https://xavio-design.imgix.net/storage/uploads/about-images/gray-wing_vqggj.svg?w=3860&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }   "></div>
        <div class="row row--g-20 align-items-center justify-content-between">
            <div class="col-lg-12">
                {!! $content !!}
            </div>
        </div>
        </section>
    </main>
@endsection