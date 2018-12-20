@if (Session::has('save'))

 	<div class="alert alert-success ks-solid-light" role="alert">
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="la la-close"></span>
        </button>
 		<strong>{{ Session::get('save') }}</strong>
 	</div>

@endif

@if (Session::has('update'))

 	<div class="alert alert-success ks-solid-light" role="alert">
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="la la-close"></span>
        </button>
 		<strong>{{ Session::get('update') }}</strong>
 	</div>

@endif

@if (Session::has('delete'))

 	<div class="alert alert-success ks-solid-light" role="alert">
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="la la-close"></span>
        </button>
 		<strong>{{ Session::get('delete') }}</strong>
 	</div>

@endif

@if (Session::has('error'))

 	<div class="alert alert-danger ks-solid-light" role="alert">
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="la la-close"></span>
        </button>
 		<strong>{{ Session::get('error') }}</strong>
 	</div>

@endif