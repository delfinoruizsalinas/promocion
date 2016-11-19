<?php

  $user = $_GET['us'];
  $passwd = $_GET['pass'];
  

      if (empty($user) || empty($passwd) ) {
          $jsondata['res'] = 'error'; 
            header('location: ../logout/');
         }else {    
         require_once('../db.class.php');
         
        $usuario = DataBase::Limpiar_($user);
        $constra = DataBase::Limpiar_($passwd);

        $db = DataBase::connect();
        $db->setQuery("select id_rol, concat(nombre,' ',ap_paterno,' ',ap_materno) as nombre, id_usuario, id_cliente, count(*) as res from usuarios where usuario = '".$usuario."' and passwd = '".$constra."' and estatus = 1;");

        $row = $db->loadObject();
    	  if ($row->res == 1) {          
          session_start();    
          $_SESSION['user'] = $row;
          $jsondata['res'] = 'ok'; 
        } else {
          $jsondata['res'] = 'nok';
        }    
      }
      echo json_encode($jsondata);


?>