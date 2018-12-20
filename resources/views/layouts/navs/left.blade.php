@guest
@else
    <!-- BEGIN DEFAULT SIDEBAR -->
        <div class="ks-column ks-sidebar ks-info">
            <div class="ks-wrapper ks-sidebar-wrapper">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard')}}">
                            <span class="ks-icon la la-home"></span>
                            <span>Inicio</span>
                        </a>
                    </li>
                    @role('Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dashboard/restaurants')}}">
                                <span class="ks-icon la la-cutlery"></span>
                                <span>Restaurantes</span>
                            </a>
                        </li>
                    @endrole
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/codes')}}">
                            <span class="ks-icon la la-barcode"></span>
                            <span>Códigos</span>
                        </a>
                    </li>
                    @role('Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dashboard/users')}}">
                                <span class="ks-icon la la-users"></span>
                                <span>Usuarios</span>
                            </a>
                        </li>
                    @endrole
                </ul>
                <div class="ks-sidebar-extras-block">
                    <div class="ks-sidebar-copyright">@Tony Roma` s 2018</div>
                </div>
            </div>
        </div>
    <!-- END DEFAULT SIDEBAR -->
@endguest