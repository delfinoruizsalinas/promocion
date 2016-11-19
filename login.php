<?php 
session_start();
if (isset($_SESSION['user'])) {
	header('Location: ./promocionar.php');
}

?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>Login | Promociones</title>
		<meta name="description" content="">

<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>

	</head>
	<body>
		
		<!-- Main page container -->
	  	<section class="container login" role="main">
			<div class="col-md-6 col-md-offset-3">
				<a class="thumbnail" href="#">
					<img alt="" src="./images/milogo.jpg">
				</a>
				<div class="data-block">
					
						<fieldset>

							<div class="control-group">
								<label class="control-label" for="user">Usuario</label>
								<div class="controls">
									<input id="user" class="form-control input-lg" type="text" placeholder="Tu usuario" name="user" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="passwd">Contrase&ntilde;a</label>
								<div class="controls">
									<input id="passwd" class="form-control input-lg" type="password" placeholder="Contrase&ntilde;a" name="passwd" required>
								</div>
							</div>
							<div class="clearfix">
							&nbsp;	
							</div>
					        <p class="text-center">
								<button id="inses" class="btn btn-primary btn-lg btn-block">Ingresar</button>
							</p>
							<div class="alert alert-error" id="sms">
							</div>
						</fieldset>
					
				</div>
			</div>
		</section>
		<!-- /Main page container -->
		


			<script>
			$(document).ready(function(){ //INICIO JQUERY
				$('#sms').hide();	
				
				$('#inses').on('click', function(){
					lg();
				});

				$(document).on("keypress", function(e) {
				     if (e.which == 13) {
				         lg();
				         //lg();
				     }
				});
			
			});
			function lg(){
				var us = $('#user').val();
					var pass = $('#passwd').val();
					if (us == "") {
						$('#user').focus();
						return false;
					}if (pass == "") {
						$('#passwd').focus();
						return false;
					}
					else{
						// var datos = $('#log').serialize();
						$.ajax({
							url: './php/login/',
							type: 'GET',
							dataType: 'json',
							data: {us: us, pass: pass},
							complete: function (xhr, textStatus) {
								//called when complete
						   },
							success: function (data, textStatus, xhr) {
								//called when successful
								 //console.log(data.id_modelo);
								 // console.log(data);
								if (data.res == 'ok') {
									window.location = './promocionar.php';
								}else{
									$('#sms').fadeIn('slow');
									$('#sms').html('<strong>Error !</strong> Ocurrio un error al intentar iniciar sesion, usuario y/o contraseña incorrecto.');
								}
							},
							error: function (xhr, textStatus, errorThrown) {
								$('#sms').show();
								$('#sms').html('<strong>Error !</strong> Por el momento el sistema no esta disponible, intentalo mas tarde..');
							}
						});
					}	
			}
		</script>
	</body>
</html>
