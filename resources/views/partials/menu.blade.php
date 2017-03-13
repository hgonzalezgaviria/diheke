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
				<li ><a href="{{ URL::to('home') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>

            	@if (in_array(Auth::user()->rol->ROLE_ROL , ['audit','admin']))
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
							
							<li>
								<a href="{{ url('/sedes') }}">
									<i class="fa fa-btn fa-key"></i> Sedes
								</a>
							</li>
							<li>
								<a href="{{ url('/salas') }}">
									<i class="fa fa-btn fa-key"></i> Salas
								</a>
							</li>

							<li>
								<a href="{{ url('/equipos') }}">
									<i class="fa fa-btn fa-key"></i> Equipos
								</a>
							</li>

							
							<li>
								<a href="{{ url('/recursos') }}">
									<i class="fa fa-btn fa-key"></i> Recursos
								</a>
							</li>

							<li>
								<a href="{{ url('/politicas') }}">
									<i class="fa fa-btn fa-key"></i> Politicas
								</a>
							</li>

							<li role="separator" class="divider"></li>
							
							<li>
								<a href="{{ url('/upload') }}">
									<i class="fa fa-btn fa-key"></i> Academusoft
								</a>
							</li>

							<li role="separator" class="divider"></li>

							<li>
								<a href="{{ url('/usuarios') }}">
									<i class="fa fa-btn fa-users"></i> Usuarios Locales
								</a>
							</li>

						</ul>
					</li>
						</ul>
					</li>

					<!-- Menu de Reservas-->
					<li class="dropdown">						
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-calendar" aria-hidden="true"></i> Reservas
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/reservas/show') }}"><i class="fa fa-calendar"></i> Reservar</a></li>
									<li><a href="{{ url('/autorizarReservas') }}"><i class="fa fa-calendar-check-o"></i> Autorizar</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- FIN Menu de Reservas-->

					<!-- Menu de Consultas-->
					<li class="dropdown">						
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-search" aria-hidden="true"></i> Consultas
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/consultaPrestamos') }}"><i class="fa fa-ticket"></i> Prestamos</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- FIN Menu de Consultas-->

				@elseif (in_array(Auth::user()->rol->ROLE_ROL , ['user','estudiante','docente']))
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
							<i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->username }} ({{ Auth::user()->rol->ROLE_ROL }})
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="{{ url('/password/reset') }}">
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

