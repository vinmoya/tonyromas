@extends('cruds.form')

<!-- Form -->
@section('form')
	
	
	@if($typeForm == 'create')
		
		<h5 class="card-title">Crear Nuevo Restaurante</h5>

		{!! Form::open(['route' => $options['route'].'.store', 'enctype' => 'multipart/form-data', 'class' => 'col-md-12', 'autocomplete' => 'off']) !!}
	@else

		<h5 class="card-title">Actualizar Restaurant</h5>

		{{ Form::model($row, ['route' => [$options['route'].'.update', @$row->id], 'method' => 'patch', 'enctype' => 'multipart/form-data', 'class' => 'col-md-12']) }}
	@endif
		{{ csrf_field() }}
		<div class="form-group">
			<label for="name">Nombre <span class="text-danger">(*)</span></label>
			<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', @$row->name) }}" autofocus required>
				@if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
		</div>

		<div class="form-group">
			<label for="address">Dirección <span class="text-danger">(*)</span></label>
			<input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address', @$row->address) }}" required>
				@if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
		</div>

		<div class="col-xs-12">
			<hr>
			<div class="row">
				<div class="col">
					<div class="form-group col text-center">
						@if($typeForm == 'create')
							<button type="submit" class="btn btn-primary ks-light ks-rounded">Registrar</button>
							
							<a href="{{ Route($options['route'].'.index') }}" class="btn btn-danger ks-light ks-rounded">
								Regresar
							</a>

						@else
							<button class="btn btn-primary ks-light ks-rounded">Actualizar</button>
							
							<a href="{{ Route($options['route'].'.index') }}" class="btn btn-danger ks-light ks-rounded">
								Regresar
							</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}

@endsection
