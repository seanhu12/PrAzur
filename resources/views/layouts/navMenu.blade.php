<div class="header collapse d-lg-flex p-0 bg-cyan-lighter" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item" style="padding: 0.5rem 0.75rem;">
                        <a href="/home" class="text-default"><i class="fas fa-chart-line"></i> Dashboard</a>
                    </li>
                    @if(Auth::user()->has_rol('Gestor de Ventas'))
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown" style="color: #495057"><i class="fas fa-business-time"></i> Ventas</a>
                            <div class="dropdown-menu dropdown-menu-arrow">
                                <a href="/propuesta" class="dropdown-item ">Propuestas</a>
                            </div>
                        </li>
                    @endif
                    {{-- @if(Auth::user()->has_rol('Gestor de Servicios')||Auth::user()->has_rol('Gestor de Ventas')||Auth::user()->has_rol('Diseñador Técnico')||Auth::user()->has_rol('Administrador de Servicios')) --}}
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown" style="color: #495057"><i class="fas fa-tasks"></i> Gestión de Servicios</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            @if(Auth::user()->has_rol('Gestor de Ventas'))
                                <a href="/servicio/create" class="dropdown-item ">Crear Servicio</a>
                            @endif
                            {{-- @if(Auth::user()->has_rol('Gestor de Servicios'||Auth::user()->has_rol('Diseñador Técnico')||Auth::user()->has_rol('Administrador de Servicios'))) --}}
                            <a href="/servicio" class="dropdown-item ">Servicios</a>
                            {{-- @endif --}}
                        </div>
                    </li>
                    {{-- @endif --}}
                    {{--@if(Auth::user()->has_rol('Encargado de Finanzas'))
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fas fa-coins"></i> Finanzas</a>
                            <div class="dropdown-menu dropdown-menu-arrow">
                                <a href="/orden_compra" class="dropdown-item ">Ordenes de Compra</a>
                            </div>
                        </li>
                    @endif--}}
                    @if(Auth::user()->has_rol('Gestor de Recursos')||Auth::user()->has_rol('Administrador de Usuarios')
                    ||Auth::user()->has_rol('Gestor de Cursos')||Auth::user()->has_rol('Diseñador Técnico')
                    ||Auth::user()->has_rol('Gestor de Empresas')||Auth::user()->has_rol('Gestor de Ventas')||Auth::user()->has_rol('Administrador de Servicios'))
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown" style="color: #495057"><i class="fas fa-cog"></i> Administración</a>
                            <div class="dropdown-menu dropdown-menu-arrow">
                                @if(Auth::user()->has_rol('Gestor de Empresas'))
                                    <a href="/contacto_empresa" class="dropdown-item ">Contactos Empresas</a>
                                    <a href="/contacto_otic" class="dropdown-item ">Contactos OTIC</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Cursos')||Auth::user()->has_rol('Diseñador Técnico'))
                                    <a href="/curso" class="dropdown-item ">Cursos</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Recursos'))
                                    <a href="/documento" class="dropdown-item ">Documentos</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Empresas')||Auth::user()->has_rol('Gestor de Ventas'))
                                    <a href="/empresa" class="dropdown-item ">Empresas</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Recursos'))
                                    <a href="/notebook" class="dropdown-item ">Notebooks</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Empresas'))
                                    <a href="/otic" class="dropdown-item ">OTICs</a>
                                @endif
                                @if(Auth::user()->has_rol('Administrador de Servicios'))
                                    <a href="/parametro/edit_parametros" class="dropdown-item ">Parámetros</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Recursos'))
                                    <a href="/pendon" class="dropdown-item ">Pendones</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Cursos')||Auth::user()->has_rol('Diseñador Técnico'))
                                    <a href="/programa" class="dropdown-item ">Programas</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Recursos'))
                                    <a href="/proyector" class="dropdown-item ">Proyectores</a>
                                @endif
                                @if(Auth::user()->has_rol('Gestor de Recursos'))
                                    <a href="/relator" class="dropdown-item ">Relatores</a>
                                    <a href="/tematica" class="dropdown-item ">Temáticas</a>
                                @endif
                                @if(Auth::user()->has_rol('Administrador de Usuarios'))
                                    <a href="/usuario" class="dropdown-item ">Usuarios</a>
                                @endif
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
