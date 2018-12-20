@extends('cruds.table')

@section('page-title')
	<h3 class="card-header">
		Usuarios	
	</h3>
@endsection

<!-- Table Titles -->
@section('table-titles')
	<th>Usuario</th>
	<th>Rol</th>
	<th>Login</th>
	<th>Acciones</th>
@endsection

<!-- Table Content -->
@section('table-rows')
	@foreach ($array as $row)
		<tr>
			<td>
				{{ $row->name }}
			</td>
			<td>
				{{ $row->roles()->pluck('name')->implode(' ') }}
			</td>
			<td>
				{{ $row->login }}
			</td>
			<td>
              	
				<!-- Action buttons -->
				<div>
					{!! Form::open(array('route' => array($options['route'].'.destroy', $row->id), 'method' => 'DELETE', 'id' => 'myform'.$row->id)) !!}

						<a href="{{ route($options['route'].'.show', $row->id) }}" class="btn btn-warning btn-sm"> 
							<i class="la la-small la-edit"></i> 
						</a>

						<button type="button" data-id="<?php echo $row->id; ?>" class="btn btn-danger btn-sm delete"><i class="la la-small la-trash"></i></button>

					{!! Form::close() !!}
				</div>
			</td>
		</tr>
	@endforeach
@endsection

<!-- Card Footer -->
@section('card-footer')
	<div class="mx-auto" style="width: 200px;">
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ Route($options['route'].'.create') }}">
				<button type="button" class="btn btn-primary">Crear Nuevo Usuario</button>
			</a>
		</div>
	</div>
@endsection