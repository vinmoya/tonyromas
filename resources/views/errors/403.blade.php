<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error 403 - Acceso restringido!</title>
    @include('layouts.styles')
</head>
    <body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading">

        <div class="ks-page-content">
            <div class="ks-page-content-body ks-error-page">
                <div class="ks-error-code">403</div>
                <div class="ks-error-description">Acceso Restringido!!</div>
                    @guest()
                    	<a href="{{ url('login') }}" class="btn btn-primary ks-light">Ir al inicio de sesión</a>
                    @else
                    	<a href="{{ url('dashboard') }}" class="btn btn-primary ks-light">Regresar al menú principal</a>
                    @endguest
            </div>
        </div>
    </body>
</html>