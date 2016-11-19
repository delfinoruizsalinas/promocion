<?php 

	session_start();
   
	if (empty($_SESSION['user'])) {
	     header("location: ./login.php");
	}

?>
<!DOCTYPE html>
<html ng-app="App">
<head>
	<title>Promoción</title>

<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>

</head>
<body>
<div class="container">
<!-- menu -->
<?php  include("menu.php") ?>


<!-- end menu -->
	<div class="row" ng-controller="recuperarUsuaruios">
		<div class="col-md-8">
			<form>
			    <div class="form-group">
			      <div class="input-group">
			        <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
			        <input type="text" class="form-control" placeholder="Buscar Promoción" ng-model="buscar">
			      </div>      
			    </div>
			</form>

			<h3>Promociones</h3>
			<table class="table table-striped">
			<thead>
				<td>
				    Clasificación 
				</td>
				<td>
	          		Promoción 
		        </td>
				<td>
	          		Producto(s)
		        </td>
		        <td>
	          		Descripcion
		        </td>
		        <td>
	          		Imagen
		        </td>
		        <td>
	          		Precio de venta 
		        </td>
		        <td>
	          		Acción 
		        </td>
			</thead>
				<tbody>
					<tr ng-repeat="us in arrPromociones | filter:buscar">
				  		<td>{{ us.clasificacion }}</td>
						<td>{{ us.nombre_promocion }}</td>
						<td>{{ us.nombre_producto }}</td>
						<td>{{ us.descripcion }}</td>
						<td><!-- <img width="100%" ng-src="{{us.imagen}}"/> -->
							<img src="<?php echo "http://dersacom.com/promocion/php/imagenes/?uid={{us.id_promo}}&tkn={{us.estatus}}&sz=50" ?>" />
						</td>
						<td>{{ us.precio_venta | currency:"$":2 }}</td>
						<td>
<!-- 							<button type="button" class="btn btn-primary btn-xs" ng-click="edit($index)">
								<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
							</button>
 -->							<button type="button" class="btn btn-danger btn-xs" ng-click="elim($index)">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>
						</td>
				  	</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-4">
			<form name="promoForm">
			    <div class="form-group">
			      <div class="input-group">
			        <input type="text" class="form-control" placeholder="Clasificación" ng-model="clasificacion" name="clasificacion" required>
			        <span ng-show="!promoForm.$pristine && promoForm.clasificacion.$error.required">Dato requerido.</span>
			      </div>      
			    </div>
			    <div class="form-group">
			      <div class="input-group">
			        <input type="text" class="form-control" placeholder="Promoción" ng-model="promocion" name="promocion" required>
			        <span ng-show="!promoForm.$pristine && promoForm.promocion.$error.required">Dato requerido.</span>
			      </div>      
			    </div>
			    <div class="form-group">
			      <div class="input-group">
			        <input type="text" class="form-control" placeholder="Producto" ng-model="producto" name="producto" required>
			        <span ng-show="!promoForm.$pristine && promoForm.producto.$error.required">Dato requerido.</span>
			      </div>      
			    </div>
			    <div class="form-group">
			      <div class="input-group">
			      	<textarea class="form-control" placeholder="Descripcion" ng-model="descripcion" name="descripcion" required></textarea>
			        <span ng-show="!promoForm.$pristine && promoForm.descripcion.$error.required">Dato requerido.</span>
			      </div>      
			    </div>
			    <div class="form-group">
			      <div class="input-group">
			        <input type="text" class="form-control" placeholder="Precio" ng-model="precio" name="precio" required>
			        <span ng-show="!promoForm.$pristine && promoForm.precio.$error.required">Dato requerido.</span>
			      </div>      
			    </div>
		        <div>
		            <label for="inputImage2">Imagen</label>

		            <input id="inputImage2" 
		                type="file" 
		                accept="image/*" 
		                image="image2" 
		                resize-max-height="600"
		                resize-max-width="600"
		                resize-quality="0.7" />		            
		            <!-- <img ng-show="image2" ng-src="{{image2.url}}" type="{{image2.file.type}}"/> -->

		            <img ng-show="image2" ng-src="{{image2.resized.dataURL}}"/>
		            <!-- <button type="submit" ng-click="single(image2.resized)" disabled>Add</button> -->
		        </div>
		        <hr />

			    <div class="form-group">
			    	<div class="input-group">
			    		<label id="sms" class="label label-primary"></label>
			    		
			    		<input type="button" class="btn btn-info" ng-click="addPromocion(image2.resized)"  value="Guardar" ng-disabled="!promoForm.$valid">
			    	</div>				    	
			    </div>
			</form>
			

		</div>
	</div>	
	
</div>
</body>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/imageupload.js"></script>
</html>