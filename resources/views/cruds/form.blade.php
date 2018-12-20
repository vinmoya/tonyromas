@extends('layouts.template-main')

@section('content')
	
	<!-- Load Form -->
	<div class="row">
	  	<div class="col-4 col-md-2"></div>
	  	<div class="col-10 col-md-8">
	  		
			<div class="col-12 ks-panels-column-section">
				<div class="card">
					<div class="card-block">
						@yield('form')
					</div>
				</div>
			</div>

	  	</div>
	  	<div class="col-4 col-md-2"></div>
	</div>

@endsection