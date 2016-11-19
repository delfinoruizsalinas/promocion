angular.module("MyFirstApp",[])

.controller("FirstController",function($scope,$http){

	$scope.slides = [];
	$scope.rss = [];

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

		primerDato = {"esta": "active", "clasificacion" : a, 'descripcion':d,'id_promo':id, 'imagen': ima, 'nombre_producto': prod, 'nombre_promocion':prom, 'precio_venta': pre, 'estatus': est}
		//console.log(primerDato);
		$scope.slides.splice(0,1,primerDato);
		}
	}).error(function() {});


	// $http.get("https://es-us.deportes.yahoo.com/f%C3%BAtbol/mexicano/?format=rss").success(function(data){// cargar lista de usuarios 
	// console.log(data);
	// }).error(function() {});

	// $http.get("https://es-us.deportes.yahoo.com/f%C3%BAtbol/mexicano/?format=rss")
	// 	.success(function(data){ 
	// 		console.log(data);
	// 		//$scope.posts = data;
	// 	})
	// 	.error(function() {
	// 		/* Act on the event */
	// 	});
	
	// var Feed = require('rss-to-json');
 
	// Feed.load('https://codek.tv/feed/', function(err, rss){
	//     console.log(rss);
	// });


});

  // function loadFeed(){ // wrapper function
  //   $('#divRss').FeedEk({
  //    FeedUrl : 'https://es-us.deportes.yahoo.com/f%C3%BAtbol/mexicano/?format=rss',
  //    MaxCount : 3,
  //    ShowDesc : true,
  //    ShowPubDate: true
  //   }); 
  // } // /wrapper
  // loadFeed();
  // setInterval(loadFeed, 64 * 1000 );

