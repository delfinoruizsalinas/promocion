<?php 
//error_reporting(0);
require_once('./db.class.php');
// Hacemos la conexión
$db = DataBase::connect();

$data = json_decode(file_get_contents("php://input"));


$id_reg_eliminar = $data->id_promo;

// echo $id_reg; 

$db->setQuery('delete from promo where id_promo = '.$id_reg_eliminar.';');

if($db->alter()){
	
	$db->setQuery('SELECT * FROM promo where estatus = 1');
	$rows = $db->loadObjectList();

	foreach($rows as $cl){
	$jsondata[] = array('id_promo' => $cl->id_promo, 'clasificacion' => $cl->clasificacion, 'nombre_producto' => $cl->nombre_producto,'descripcion' => $cl->descripcion,'imagen' => $cl->imagen,'precio_venta' => $cl->precio_venta, 'nombre_promocion'=>$cl->nombre_promocion, 'estatus' => $cl->estatus);
	}
    echo json_encode($jsondata);

}
else{
    echo 'Error: '.$db->getError();
}

?>