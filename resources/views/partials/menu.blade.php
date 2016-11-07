<!-- Menú -->
<nav role="navigation" class="navbar navbar-default">
	<div class="navbar-header">
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="{{ URL::to('home') }}" class="pull-left">
			<img src="{{ asset('assets/img/logo_redondo.jpg') }}" height="44">
		</a>
	</div>
	<div class="container-fluid">

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div id="navbarCollapse" class="collapse navbar-collapse">
			@unless (Auth::guest())
				<ul class="nav navbar-nav">
					<li ><a href="{{ URL::to('home') }}"><i class="fa fa-home" aria-hidden="true"></i>Inicio</a></li>

            	@if (in_array(Auth::user()->role , ['audit','admin']))
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

							<li><a href="{{ url('/recursos') }}"><i class="fa fa-btn fa-key"></i> Recursos de Salas</a></li>

							<li><a href="{{ url('/situacionrecursofisico') }}"><i class="fa fa-btn fa-key"></i> Situacion Recursos Físicos</a></li>

							<li><a href="{{ url('/elementorecursofisico') }}"><i class="fa fa-btn fa-key"></i> Elementos Recursos Físicos</a></li>

							<li><a href="{{ url('/estadoelementorecursofisico') }}"><i class="fa fa-btn fa-key"></i> Estado Elemento Recursos Físicos</a></li>

							<li><a href="{{ url('/tiporecursofisico') }}"><i class="fa fa-btn fa-key"></i> Tipos de Recursos Fisicos </a></li>


						</ul>
					</li>
						</ul>
					</li>
					<li>
						<a href="{{ url('/charts') }}">
							<i class="fa fa-line-chart" aria-hidden="true"></i> Informes
						</a>
					</li>
				@elseif (in_array(Auth::user()->role , ['user','estudiante','docente']))
					<li>
						<a href="{{ url('/prueba') }}">
							<i class="fa fa-list" aria-hidden="true"></i> Presentar Reserva
						</a>
					</li>
				@endif
					<li><a href="{{ url('/help') }}"><i class="fa fa-life-ring" aria-hidden="true"></i> Ayuda</a></li>
				</ul>
			@endunless

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
					<!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} ({{ Auth::user()->role }})
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-key"></i> Editar</a></li>
							<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>


		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!-- Fin Menú -->

