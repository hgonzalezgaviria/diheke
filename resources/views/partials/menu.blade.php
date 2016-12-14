<!-- Menú -->
<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">

		<!-- Brand y toggle se agrupan para una mejor visualización en dispositivos móviles -->
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Menú</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="{{ URL::to('home') }}" class="pull-left">
				<img src="{{ asset('assets/img/LOGO UNIAJC.png') }}" height="50" style="padding-top:5px; padding-left:5px; padding-bottom:5px;">
			</a>
		</div>

		<!-- Recopila los vínculos de navegación, formularios y otros contenidos para cambiar -->
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">

			@unless (Auth::guest())
				<li ><a href="{{ URL::to('home') }}"><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>

            	@if (in_array(Auth::user()->rol->ROLE_rol , ['audit','admin']))
					<li class="dropdown">
						
						<ul class="nav navbar-nav">
							<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-check-square" aria-hidden="true"></i> Maestros del Sistema
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/tipoestados') }}"><i class="fa fa-btn fa-key"></i> Tipos de Estados</a></li>

							<li><a href="{{ url('/estados') }}"><i class="fa fa-btn fa-sign-out"></i> Estados </a></li>

							<li role="separator" class="divider"></li>
							
							<li><a href="{{ url('/recursos') }}"><i class="fa fa-btn fa-key"></i> Recursos de Salas</a></li>

							<li role="separator" class="divider"></li>
							
							<li><a href="{{ url('/elementorecursofisico') }}"><i class="fa fa-btn fa-key"></i> Elementos Recursos Físicos</a></li>

							<li><a href="{{ url('/estadoelementorecursofisico') }}"><i class="fa fa-btn fa-key"></i> Estado Elemento Recursos Físicos</a></li>

							<li role="separator" class="divider"></li>
							
							<li><a href="{{ url('/espaciofisico') }}"><i class="fa fa-btn fa-key"></i> Espacios Físicos </a></li>

							<li><a href="{{ url('/tipoespaciofisico') }}"><i class="fa fa-btn fa-key"></i> Tipos de Espacios Físicos </a></li>

							<li><a href="{{ url('/tipoposesion') }}"><i class="fa fa-btn fa-key"></i> Tipos de Posesión </a></li>

							<li><a href="{{ url('/localidad') }}"><i class="fa fa-btn fa-key"></i> Localidades </a></li>

							<li><a href="{{ url('/tiporecursofisico') }}"><i class="fa fa-btn fa-key"></i> Tipos de Recurso Físico </a></li>

							<li><a href="{{ url('/situacionrecursofisico') }}"><i class="fa fa-btn fa-key"></i> Situaciones Recursos Físicos</a></li>

							<li><a href="{{ url('/recursofisico') }}"><i class="fa fa-btn fa-key"></i> Recursos Físicos </a></li>

							<li role="separator" class="divider"></li>

							<li><a href="{{ url('/tipounidad') }}"><i class="fa fa-btn fa-key"></i> Tipos de Unidades</a></li>

							<li><a href="{{ url('/unidad') }}"><i class="fa fa-btn fa-key"></i> Unidades </a></li>

							<li role="separator" class="divider"></li>

							<li><a href="{{ url('/usuarios') }}"><i class="fa fa-btn fa-users"></i> Usuarios Locales</a></li>

						</ul>
					</li>
						</ul>
					</li>
					<li>
						<a href="{{ url('/reservas/show') }}">
							<i class="fa fa-calendar" aria-hidden="true"></i> Reservas
						</a>
					</li>
				@elseif (in_array(Auth::user()->rol->ROLE_rol , ['user','estudiante','docente']))
					<li>
						<a href="{{ url('/prueba') }}">
							<i class="fa fa-list" aria-hidden="true"></i> Presentar Reserva
						</a>
					</li>
				@endif
			@endunless
			</ul>

			<!-- Lado derecho del Navbar. -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Ayuda -->
					<li><a href="{{ url('/help') }}">
						<i class="fa fa-life-ring" aria-hidden="true"></i> Ayuda
					</a></li>
				<!-- Autenticación. -->
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">
						<i class="fa fa-sign-in" aria-hidden="true"></i> Login
					</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->username }} ({{ Auth::user()->rol->ROLE_rol }})
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="{{ url('password/reset?USER_id='.Auth::user()->USER_id) }}">
									<i class="fa fa-btn fa-key"></i> Cambiar contraseña
								</a>
							</li>

							<li>
								<a href="{{ url('/logout') }}">
									<i class="fa fa-btn fa-sign-out"></i> Logout
								</a>
							</li>
						</ul>
					</li>
				@endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!-- Fin Menú -->

