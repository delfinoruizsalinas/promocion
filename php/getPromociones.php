<?php 
//error_reporting(0);
require_once('./db.class.php');
// Hacemos la conexión
$db = DataBase::connect();

$db->setQuery('SELECT * FROM promo where estatus = 1');
$rows = $db->loadObjectList();

foreach($rows as $cl){
	$jsondata[] = array('id_promo' => $cl->id_promo, 'clasificacion' => $cl->clasificacion, 'nombre_producto' => $cl->nombre_producto,'descripcion' => $cl->descripcion,'imagen' => $cl->imagen,'precio_venta' => $cl->precio_venta, 'nombre_promocion'=>$cl->nombre_promocion, 'estatus' => $cl->estatus);
 
}
    echo json_encode($jsondata);

?>