angular.module("Menu",[])
.controller("menuController",function($scope,$http){
	
	var datMenu = [
	{
		nombre : 'Clientes',
	    url: 'clientes.php'
	},
	{
		nombre : 'Pagos',
	    url: 'clientes.php'
	}
	];

	//console.log(datMenu);

});

