angular.module("MyFirstApp",[])

.controller("FirstController",function($scope,$http){

	$scope.slides = [];
	//$scope.rss = [];

	

	$http.get("./php/getPromociones.php").success(function(data){// cargar lista de usuarios 
	if(data[0].id_promo >=1){ //excepxcion cunado esta vacia la tabla
		//$scope.arrPromociones.push(data);
		$scope.slides = data;
		$scope.carouselTimer = 5000;
		 prod = $scope.slides[0].nombre_producto;
		 a = $scope.slides[0].clasificacion;
		 d = $scope.slides[0].descripcion;
		 id = $scope.slides[0].id_promo;
		 ima = $scope.slides[0].imagen;
		 prom = $scope.slides[0].nombre_promocion;
		 pre = $scope.slides[0].precio_venta;
		 est = $scope.slides[0].estatus;

		 //azteca deportes
		 $http.get("https://api.rss2json.com/v1/api.json?rss_url=http://www.aztecanoticias.com.mx/rss/entretenimiento.xml")
		.success(function(data){ 
			deportes = {"clasificacion" : data.items[0].categories[0], 'descripcion':data.feed.description, 'id_promo':15 ,'imagen': data.feed.image, 'nombre_producto': data.items[0].content, 'nombre_promocion':data.items[0].description, 'fecha': data.items[0].pubDate,'estatus': 2};
			$scope.slides.push(deportes);
			//console.log($scope.slides);
		})
		.error(function() {
		});

		 //azteca finanzas
		$http.get("https://api.rss2json.com/v1/api.json?rss_url=http://www.aztecanoticias.com.mx/rss/finanzas.xml")
		.success(function(data){ 
			finanzas = {"clasificacion" : data.items[0].categories[0], 'descripcion':data.feed.description, 'id_promo':16 ,'imagen': data.feed.image, 'nombre_producto': data.items[0].content, 'nombre_promocion':data.items[0].description, 'fecha': data.items[0].pubDate,'estatus': 2};
			$scope.slides.push(finanzas);
			//console.log($scope.slides);
		})
		.error(function() {
		});

		//azteca salud
		$http.get("https://api.rss2json.com/v1/api.json?rss_url=http://www.aztecanoticias.com.mx/rss/salud.xml")
		.success(function(data){ 
			salud = {"clasificacion" : data.items[0].categories[0], 'descripcion':data.feed.description, 'id_promo':17 ,'imagen': data.feed.image, 'nombre_producto': data.items[0].content, 'nombre_promocion':data.items[0].description, 'fecha': data.items[0].pubDate,'estatus': 2};
			$scope.slides.push(salud);
			//console.log($scope.slides);
		})
		.error(function() {
		});

		
		// Estados
		$http.get("https://api.rss2json.com/v1/api.json?rss_url=http://www.aztecanoticias.com.mx/rss/todas.xml")
		.success(function(data){ 
			segundoDato = {"clasificacion" : data.items[0].categories[0], 'descripcion':data.feed.description, 'id_promo':18 ,'imagen': data.feed.image, 'nombre_producto': data.items[0].content, 'nombre_promocion':data.items[0].description, 'fecha': data.items[0].pubDate,'estatus': 2};
			$scope.slides.push(segundoDato);
			//console.log($scope.slides);
		})
		.error(function() {
		});



		primerDato = {"esta": "active", "clasificacion" : a, 'descripcion':d,'id_promo':id, 'imagen': ima, 'nombre_producto': prod, 'nombre_promocion':prom, 'precio_venta': pre, 'estatus': est}
		//console.log(primerDato);
		$scope.slides.splice(0,1,primerDato);
		}
	}).error(function() {});




});
