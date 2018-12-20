@extends('cruds.table')

<!-- Page titles -->

@section('page-title')
	<h3 class="card-header">
		Restaurantes	
	</h3>
@endsection

<!-- Table Titles -->
@section('table-titles')
	<th>ID</th>
	<th>Nombre</th>
	<th>Dirección</th>
	<th>Acciones</th>
@endsection

<!-- Table Content -->
@section('table-rows')
	@foreach ($array as $row)
		<tr>
			
			<td>
				{{ $row->id }}
			</td>
			<td>
				{{ $row->name }}
			</td>
			<td>
				{{ $row->address }}
			</td>
			<td>
				<!-- Action buttons -->
				<div>
					{!! Form::open(array('route' => array($options['route'].'.destroy', $row->id), 'method' => 'DELETE')) !!}

						<a href="{{ route($options['route'].'.show', $row->id) }}" class="btn btn-warning btn-sm"> 
							<i class="la la-small la-edit"></i> 
						</a>


						<button type="submit" class="btn btn-danger btn-sm sweet-5"><i class="la la-small la-trash"></i></button>

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
				<button type="button" class="btn btn-primary">Crear Nuevo Restaurante</button>
			</a>
		</div>
	</div>
@endsection