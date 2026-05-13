@extends('backend.layouts.layout')

@section('content')
<section class="align-items-center d-flex h-100 bg-white" style="margin-top: 215px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto text-center py-4">
				<img src="{{ static_asset('assets/img/maintainance.svg') }}" class="img-fluid w-75">
			    <h3 class="fw-600 mt-5">{{translate('We are Under Maintenance.')}}</h3>
			    <div class="lead">{{translate('We will be back soon!')}}</div>
			</div>
			<div class="container-narrow">
				<p class="headline-1 color-gold mb-10em">Maintenance</p>
				<h1 class="headline-3 letters js-wordsplit text-center mb-10em">We are Under Maintenance. We will be back soon!</h1>
				<p class="text-center">
				<a href="#" class="btn btn--bordered reload-home" title="Return to Xavio">Return to Archiplus</a>
				</p>
			</div>
		</div>
	</div>
</section>
@endsection
