
<nav class="navbar navbar-inverse"> 
	<div class="container-fluid"> 
		<div class="navbar-header"> 
			<button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button>
			<a href="#" class="navbar-brand">Mi tienda</a> 
		</div> 
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9"> 
			<ul class="nav navbar-nav"> 
				<li>
					<a href="promocionar.php">Inicio</a>
				</li>
			</ul>
			<ul class="nav navbar-nav"> 
				<li>
					<a href="publicados.php" target="_blank">Publicados</a>
				</li>
			</ul>
			<ul class="nav navbar-nav pull-right"> 
				<li>
					<a href="./php/logout/">Cerrar Sesión</a>
				</li>
			</ul>  
			<ul class="nav navbar-nav pull-right"> 
				<li>
					<a style="color:white;"><?php echo $_SESSION['user']->nombre; ?></a>
				</li>
			</ul>
		</div> 
	</div> 
</nav>
