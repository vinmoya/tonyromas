@extends('layouts.template-main')

@section('content')

        <div class="ks-page-content">
            <div class="ks-page-content-body ks-error-page">
                <div class="ks-error-code">404</div>
                <div class="ks-error-description">El pagina solicitada, no existe!!</div>
                @guest()
                	<a href="{{ url('login') }}" class="btn btn-primary ks-light">Ir al inicio de sesión</a>
                @else
                	<a href="{{ url('dashboard') }}" class="btn btn-primary ks-light">Regresar al menú principal</a>
                @endguest
            </div>
        </div>

@endsection