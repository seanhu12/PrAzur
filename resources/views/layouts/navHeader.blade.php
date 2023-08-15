
<div class="d-flex">
    <a class="header-brand" href="/home">
        <img src="/imagenes/logo_texto.png" alt="ADS Consultores" height="40" width="76">
    </a>
    <div class="d-flex order-lg-2 ml-auto">
        <!-- Notication -->
        <div class="dropdown">
            <a class="nav-link icon" data-toggle="dropdown">
                <i class="fas fa-bell fa-2x" style="color: #fff; margin-top: 5px;"></i>
                @if(Auth::user()->hayNoLeidas())
                    <span id="sin-leer" class="nav-unread"></span>
                @else
                    <span id="sin-leer" class="nav-unread" hidden></span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right scrollable-menu dropdown-menu-arrow">
                @foreach(Auth::user()->get_notificaciones() as $notificacion)
                    <div id="notificacion-{{$notificacion->id}}" class="dropdown-item-notificacion d-flex">
                        <button style="margin-right: 0.5rem;" class="btn btn-secondary-sin-borde" onclick="deshabilitarNotificacion({{$notificacion->id}});"><i class="fas fa-times"></i></button>
                        <div onclick="leer({{$notificacion->id}},'{{$notificacion->direccion}}')" style="color: #495057; margin-right: 0.5rem; cursor: pointer;">
                            <div>
                                @if($notificacion->leido_si_no == 0)
                                    <div id="notificacion-mensaje-{{$notificacion->id}}"><strong>{{$notificacion->mensaje}}</strong></div>
                                    @if ($notificacion->tipo == 'Atraso')
                                        <div class="small text-muted" style="color:red !important">{{date("d-m-Y", strtotime($notificacion->created_at))}}</div>
                                    @else
                                        <div class="small text-muted" style="color:orange !important">{{date("d-m-Y", strtotime($notificacion->created_at))}}</div>
                                    @endif
                                @else
                                    <div id="notificacion-mensaje-{{$notificacion->id}}">{{$notificacion->mensaje}}</div>
                                    @if ($notificacion->tipo == 'Atraso')
                                        <div class="small text-muted" style="color:red !important">{{date("d-m-Y", strtotime($notificacion->created_at))}}</div>
                                    @else
                                        <div class="small text-muted" style="color:orange !important">{{date("d-m-Y", strtotime($notificacion->created_at))}}</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="dropdown-divider"></div>
                <a href="usuario/notificaciones/{{Auth::user()->id}}" class="dropdown-item text-center">Ver todas las notificaciones</a> --}}
                {{-- <button onclick="leerTodas({{Auth::user()->id}},'{{Auth::user()->get_notificaciones()}}')" class="dropdown-item text-center">Marcar como leídas</button> --}}
            </div>
        </div>
        <!-- Nav profile -->
        <div class="dropdown">
            {{-- <a class="nav-link icon" data-toggle="dropdown">
                <span class="text-default" style="font-size:25px"><i class="fas fa-user"></i> {{Auth::user()->get_nombre_completo()}}</span>
            </a> --}}
            <a class="nav-link pr-0 leading-none" data-toggle="dropdown">
                <i class="fas fa-user-circle fa-2x" style="margin-top: 5px; color: #fff;"></i>
                {{-- <span class="ml-2 d-none d-lg-block">
                    <span class="text-default" style="font-size:25px"> {{Auth::user()->get_nombre_completo()}}</span>
                </span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                {{-- <div class="dropdown-item"> {{Auth::user()->get_nombre_completo()}}</div>
                <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="/usuario/show/{{Auth::user()->id}}">
                    <i class="dropdown-icon fe fe-user"></i> {{Auth::user()->get_nombre_completo()}}
                </a>
                <a href="/usuario/notificaciones/{{Auth::user()->id}}" class="dropdown-item">
                    <i class="dropdown-icon fas fa-envelope"></i> Ver mis notificaciones
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="dropdown-icon fe fe-log-out"></i> Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
        <span class="header-toggler-icon"></span>
    </a>
</div>
