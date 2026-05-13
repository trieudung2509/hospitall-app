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
          
        <section class=" section section--p-none-top section--p-none-bottom">
        <div class="container  ">
            <div class="row">
            <div class="col-lg-6">
                <div class="content mb-20em"></div>
                <form id="form_builder_2a4582f4e13ab499fa90a0348a27ff91" name="Contact form" class=" form form--two-column" onsubmit="return App.submitForm({form: this, url: '{{ route('contact.save') }}'});">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form__group mb-20em ">
                    <input data-form-id="form_builder_2a4582f4e13ab499fa90a0348a27ff91" type="text" class="js-form-builder-field form__input" name="first_name" id="bp51320d78e8be5a11a8a2cafcec492aae" required>
                    <label class="form__label" for="bp51320d78e8be5a11a8a2cafcec492aae"> First Name </label>
                </div>
                <div class="form__group mb-20em ">
                    <input data-form-id="form_builder_2a4582f4e13ab499fa90a0348a27ff91" type="text" class="js-form-builder-field form__input" name="last_name" id="bp6728c0f6ed50c1f4559285c3b91e3a5a" required>
                    <label class="form__label" for="bp6728c0f6ed50c1f4559285c3b91e3a5a"> Last Name </label>
                </div>
                <div class="form__group mb-20em ">
                    <input data-form-id="form_builder_2a4582f4e13ab499fa90a0348a27ff91" type="text" class="js-form-builder-field form__input" name="phone_number" id="bp53463950ddeb97d4a23f3134eccd1ffc" required>
                    <label class="form__label" for="bp53463950ddeb97d4a23f3134eccd1ffc"> Contact number </label>
                </div>
                <div class="form__group mb-20em ">
                    <input data-form-id="form_builder_2a4582f4e13ab499fa90a0348a27ff91" type="email" class="js-form-builder-field form__input" name="email" id="bpfc99e52247f95c7490355f9351c5d4e5" required>
                    <label class="form__label" for="bpfc99e52247f95c7490355f9351c5d4e5"> Email Address </label>
                </div>
                <div class="form__group mb-20em form__group--full-width">
                    <textarea data-form-id="form_builder_2a4582f4e13ab499fa90a0348a27ff91" class="js-form-builder-field form__textarea" name="message" id="bpec53508f6423d39f4a7e6aa7a2c89570"></textarea>
                    <label class="form__label" for="bpec53508f6423d39f4a7e6aa7a2c89570"> Message </label>
                </div>
                <div class="form__group form__group--full-width">
                    <div class="checkbox__container">
                    <input class="checkbox" type="checkbox" name="consent" id="consent-c2">
                    <label class="checkbox__label" for="consent-c2">
                        <span class="half-opacity">By checking this box, you agree to be contacted via phone and email regarding your interest in our products and services. We will treat your data in accordance with our <a href="">privacy policy</a>. </span>
                    </label>
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__row__left">
                    <div class="form__group">
                        <input type="file" name="file" id="file" class="inputfile">
                        <label class="btn btn--file" for="file">
                        <span class="btn__inner"> Choose a file </span>
                        </label>
                    </div>
                    </div>
                    <div class="form__row__right">
                    <div class="form__group">
                        <button class="btn btn--bordered btn--bordered-gold btn--full-width" type="submit"> Submit </button>
                    </div>
                    </div>
                </div>
                <div class="loading"></div>
                </form>
            </div>
            <div class="col-xl-4 offset-xl-2 col-lg-5 offset-lg-1">
                <div class="box box--padded box--bordered text-center">
                <p class="headline-6 mb-5em"> Địa chỉ </p>
                <div class="content mb-20em">
                    <p>{{ get_setting('contact_address',null,'en') }}</p>
                </div>
                <p class="headline-6 mt-20em mb-5em">Điện thoại</p>
                <a href="tel:{{ get_setting('contact_phone') }}" title="Call us" class="link">{{ get_setting('contact_phone') }}</a>
                <p class="headline-6 mt-20em mb-5em">Email</p>
                <a href="mailto:{{ get_setting('contact_email') }}" title="Email us" class="link">{{ get_setting('contact_email') }}</a>
                <p class="headline-6 mt-20em mb-5em">Social</p>
                <ul class="social social--font-lg">
                    <li class="social__item">
                    <a class="social__link" href="{{ get_setting('facebook_link') }}" title="Our Facebook" target="_blank" rel="noopener noreferrer">Facebook</a>
                    </li>
                    <!-- <li class="social__item">
                    <a class="social__link" href="https://www.linkedin.com/company/xavio-design" title="Our Linkedin" target="_blank" rel="noopener noreferrer">Linkedin</a>
                    </li> -->
                </ul>
                </div>
            </div>
            </div>
        </div>
        </section>
    </main>
@endsection