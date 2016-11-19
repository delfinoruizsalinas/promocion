<?php 
//error_reporting(0);
require_once('./db.class.php');
// Hacemos la conexión
$db = DataBase::connect();

$data = json_decode(file_get_contents("php://input"));

$n = $data->nombre;
$t = $data->telefono;
$d = $data->domicilio;
$dir = $data->direccion;
$o = $data->oficio;
$id_reg = $data->id_reg;



$db->setQuery('update usuario set nombre = "'.$n.'",telefono ="'.$t.'",domicilio = "'.$d.'", direccion= "'.$dir.'",oficio = "'.$o.'" where id_usuario ='.$id_reg);

if($db->alter()){
	
	$db->setQuery('SELECT * FROM usuario');
	$rows = $db->loadObjectList();

	foreach($rows as $cl){
		$jsondata[] = array('id_usuario' => $cl->id_usuario, 'nombre' => $cl->nombre, 'telefono' => $cl->telefono,'domicilio' => $cl->domicilio,'direccion' => $cl->direccion,'oficio' => $cl->oficio);
	 
	}
    echo json_encode($jsondata);
}
else{
    echo 'Error: '.$db->getError();
}

?>