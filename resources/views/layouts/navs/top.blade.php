@guest
@else

    <nav class="navbar ks-navbar">
        <!-- BEGIN HEADER INNER -->
        <!-- BEGIN LOGO -->
        <div href="index.html" class="navbar-brand">
            <!-- BEGIN RESPONSIVE SIDEBAR TOGGLER -->
            <a href="#" class="ks-sidebar-toggle"><i class="ks-icon la la-bars" aria-hidden="true"></i></a>
            <a href="#" class="ks-sidebar-mobile-toggle"><i class="ks-icon la la-bars" aria-hidden="true"></i></a>
            <!-- END RESPONSIVE SIDEBAR TOGGLER -->

            <div class="ks-navbar-logo">
                <img class="logo rounded mx-auto d-block" src="{{ asset('assets/css/img/logo.png') }}">
            </div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN MENUS -->
        <div class="ks-wrapper">
            <nav class="nav navbar-nav">
                <!-- BEGIN NAVBAR MENU -->
                <div class="ks-navbar-menu">
                    
                </div>
                <!-- END NAVBAR MENU -->

                <!-- BEGIN NAVBAR ACTIONS -->
                <div class="ks-navbar-actions">

                    <!-- BEGIN NAVBAR USER -->
                    <div class="nav-item dropdown ks-user">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <span>
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
                            <a class="dropdown-item" href="{{ url('dashboard/users/profile') }}">
                                <span class="la la-user ks-icon"></span>
                                <span>Modificar datos del usuario</span>
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <span class="la la-sign-out ks-icon" aria-hidden="true"></span>
                                                <span>Salir</span>
                                    </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                        </div>
                    </div>
                    <!-- END NAVBAR USER -->
                </div>
                <!-- END NAVBAR ACTIONS -->
            </nav>
        </div>
        <!-- END MENUS -->
        <!-- END HEADER INNER -->
    </nav>

@endguest