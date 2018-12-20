@extends('cruds.form')

<!-- Form -->
@section('form')
    
    <h5 class="card-title">Editar Perfil de Usuario</h5>

        {{ Form::model($row, ['route' => [$options['route'].'.profile.update', @$row->id], 'method' => 'PuT', 'enctype' => 'multipart/form-data', 'class' => 'col-md-12']) }}

        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nombre <span class="text-danger">(*)</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', @$row->name) }}" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
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

                            <button class="btn btn-primary ks-light ks-rounded">Actualizar</button>

                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection
