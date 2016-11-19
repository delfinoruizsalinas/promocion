<?php 
//error_reporting(0);
require_once('./db.class.php');
// Hacemos la conexión
$db = DataBase::connect();

$data = json_decode(file_get_contents("php://input"));

$c = $data->clasificacion;
$prom = $data->promocion;
$prod = $data->producto;
$desc = $data->descripcion;
$prec = $data->precio;
$image = $data->image;



$db->setQuery('insert into promo values(null,"'.$c.'","'.$prod.'","'.$desc.'","'.$image.'","'.$prec.'","'.$prom.'",1);');
//con los campos especificados en la consulta como propiedades.
//echo '';
if($db->alter()){
	$db->setQuery('SELECT * FROM promo where id_promo in (SELECT MAX(id_promo) AS id_promo FROM promo)');
	$cl = $db->loadObject();
 
	echo json_encode(array('id_promo' => $cl->id_promo, 'clasificacion' => $cl->clasificacion, 'nombre_producto' => $cl->nombre_producto,'descripcion' => $cl->descripcion,'imagen' => $cl->imagen,'precio_venta' => $cl->precio_venta, 'nombre_promocion'=>$cl->nombre_promocion, 'estatus' => $cl->estatus));
}
else{
    echo 'Error: '.$db->getError();
}

?>