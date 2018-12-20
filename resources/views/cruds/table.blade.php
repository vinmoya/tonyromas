@extends('layouts.template-main')

@section('content')
	
		<div class="col-12" id="table">
			<div class="panel panel-default panel-table card-outline-primary">
				
				@yield('page-title')
				
				<div class="card-block">
					<table id="ks-datatable" class="table-bordered">
							<thead class="thead-default">
								<tr>
					    			@yield('table-titles')
								</tr>
							</thead>
							<tbody>
					    		@yield('table-rows')
							</tbody>
							<tfoot>
								@yield('table-footer')
							</tfoot>
					</table>
				</div>
				<div class="card-footer">
                	@yield('card-footer')
                </div>
			</div>
		</div>

@endsection
