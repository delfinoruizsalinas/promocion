angular.module("App",['imageupload']).controller("recuperarUsuaruios",function($scope,$http){
		//variables
		$scope.arrPromociones = [];//registros
		$scope.id_reg = '';	

		$http.get("./php/getPromociones.php").success(function(data){// cargar lista de usuarios 
			if(data[0].id_promo >=1){ //excepxcion cunado esta vacia la tabla
				$scope.arrPromociones = data;
				//console.log($scope.arrPromociones);
			}
		}).error(function() {});


		$scope.addPromocion = function(image){	//Agregar o actualizar nuevo


			if ($scope.id_reg =="") {
				imag = image.dataURL; 
				

				$http.post("./php/addPromocion.php",{'clasificacion':$scope.clasificacion, 'promocion':$scope.promocion, 'producto': $scope.producto, 'descripcion': $scope.descripcion, 'precio': $scope.precio, 'image': imag})				 
				.success(function(data){ //agregar
					$scope.arrPromociones.push(data);
					//console.log(data);
					$scope.clasificacion = '';
					$scope.promocion = '';
					$scope.producto = '';
					$scope.descripcion = '';
					$scope.precio = '';

					$("#sms").text("Registro agreado correctamente");		
				})
			}else{

			}
		}

		$scope.elim = function(e){	//Eliminar registro

			var obj = $scope.arrPromociones[e];
			//console.log(obj);
			
			$http.post("./php/eliminarPromocion.php",{id_promo: obj.id_promo} ).success(function(data){ // get id domicilio
				//console.log(data);
				if(data[0].id_promo >=1){	//excepxcion cunado esta vacia la tabla
					$scope.arrPromociones = data;
				$("#sms").text("Registro eliminado correctamente");	
				}else{
					$scope.arrPromociones =[];	
				}

				// $scope.arrPromociones = data;
				// $("#sms").text("Registro eliminado correctamente");	
							
			})
		}


});

