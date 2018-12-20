@extends('cruds.form')

<!-- Form -->
@section('form')
	
	@if($typeForm == 'create')

		<h5 class="card-title">Registro de Nuevo Usuario</h5>

		{!! Form::open(['route' => $options['route'].'.store', 'enctype' => 'multipart/form-data', 'class' => 'col-md-12', 'autocomplete' => 'off']) !!}
	@else

		<h5 class="card-title">Editar Usuario</h5>

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
			<label for="rol_id">Rol <span class="text-danger">(*)</span></label>
				<select name="role_id" id="role" class="form-control" required>

					@if (!empty(@$row))
						@foreach ($row->roles as $role)
							<option value="{{ $role->id }}"> {{ $role->name }} </option>
						@endforeach
					@endif
							<option value="0">======== Seleccione una opción ========</option>
						@foreach ($roles as $role)
							<option value="{{ $role->id }}"> {{ $role->name }} </option>
						@endforeach

				</select>
		</div>
		<div class="form-group restaurant" id="restaurant_id">
			<label for="restaurant_id">Restaurant <span class="text-danger">(*)</span></label>
				<select name="restaurant_id" id="restaurant_id" class="form-control" required>
					
					@if (!empty(@$row->restaurant))
						<option value="{{ $row->restaurant->id }}" selected> {{ $row->restaurant->name }} </option>
					@endif
						<option>======== Seleccione una opción ========</option>
					@foreach ($file as $array)
						<option value="{{ $array->id }}"> {{ $array->name }} </option>
					@endforeach

				</select>
		</div>	

		<div class="form-group">
			<label for="login">Username Login <span class="text-danger">(*)</span></label>
			<input id="login" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login', @$row->login) }}" required>
				@if ($errors->has('login'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
                @endif
		</div>

		<div class="form-group">
			<label for="password">Contraseña <span class="text-danger">(*)</span></label>
			<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
				@if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
		</div>

		<div class="form-group">
			<label for="re-password">Confirmar Contraseña <span class="text-danger">(*)</span></label>
			<input id="re-password" type="password" class="form-control{{ $errors->has('re-password') ? ' is-invalid' : '' }}" name="re-password" value="{{ old('re-password') }}" required>
				@if ($errors->has('re-password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('re-password') }}</strong>
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
						@else
							<button class="btn btn-primary ks-light ks-rounded">Actualizar</button>
						@endif
						<a href="{{ Route($options['route'].'.index') }}">
							<button type="button" class="btn btn-danger ks-light ks-rounded">Regresar</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}

@endsection
