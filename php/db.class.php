<?php

class DataBase extends MySQLi{



    private $link;

    private $result;

    private $sql;

    private $lastError;

    private $resultSize;

    private static $connection;

    private static $sqlQueries;

    private static $totalQueries;

    const DB_NAME = 'promocion';

    const DB_USER = 'root';

    const DB_PSW = '';

    const DB_HOST = 'localhost';

    

    public function connect(){

        if (is_null(self::$connection)) {

            self::$connection = new DataBase();

        }

        return self::$connection;

    }



    private function __construct(){

        $this->link = parent::__construct(self::DB_HOST, self::DB_USER, self::DB_PSW, self::DB_NAME);

        if($this->connect_errno == 0){

            self::$totalQueries = 0;

            self::$sqlQueries = array();

        }

        else {

            echo 'Error en la conexion: '.$this->connect_error;

        }

    }



    private function execute(){

        if(!($this->result = $this->query($this->sql))){

            $this->lastError = $this->error;

            return false;

        }

        //self::$sqlQueries[] = $this->sql;

        //self::$totalQueries++;

        $this->resultSize = $this->result->num_rows;

        return true;

    }



    public function alter(){

        if(!($this->result = $this->query($this->sql))){

            $this->lastError = $this->error;

            return false;

        }

        //self::$sqlQueries[] = $this->sql;

        return true;

    }



    public function loadObjectList(){

        if (!$this->execute()){

            return null;

        }

        $resultSet = array();

        while ($objectRow = $this->result->fetch_object()){

            $resultSet[] = $objectRow;

        }

        $this->result->close();

        $this->next_result();

        return $resultSet;  

    }

    

    public function loadObject(){

        if ($this->execute()){

            if ($object = $this->result->fetch_object()){

                $this->result->close();

                $this->next_result();

                return $object;

            }

            else return null;

        }

        else return false;

    }

    

    public function setQuery($sql){

        if(empty($sql)){

            return false;

        }

        $this->sql = $sql;

        return true;

    }



    public function Limpiar_($var){

        $var = stripslashes($var);

        $busqueda= array(

        '@<script[^>]*?>.*?</script>@si', // javascript

        '@<[\/\!]*?[^<>]*?>@si', // HTML

        '@<style[^>]*?>.*?</style>@siU', // Css

        '@<![\s\S]*?--[ \t\n\r]*>@' // Comentarios multiples comillas simples

        );



        $salida= preg_replace($busqueda, '', $var);

        return $salida;       

    }



    public function getTotalQueries(){

        return self::$totalQueries;

    }

    

    public function getSQLQueries(){

        return self::$sqlQueries;

    }

    

    public function getError(){

        return $this->lastError;

    }

    

    public function getLastID(){

        return $this->insert_id;

    }

    function __destruct(){

        $this->close();



    }

}



/*

// Hacemos la conexión

$db = DataBase::connect();



// Supongamos que tenemos una tabla de usuarios

// Hacemos la consulta:

$db->setQuery('SELECT `id`,`nombre`,`grupo` FROM `usuarios`');



// La ejecutamos y al mismo tiempo obtenemos un arreglo de objetos

// con los campos especificados en la consulta como propiedades.

$usuarios = $db->loadObjectList();



// Los imprimimos directamente en pantalla...

foreach($usuarios as $usuario){

    echo 'ID: '.$usuario->id;

    echo 'Nombre: '.$usuario->nombre;

    echo 'Grupo: '.$usuario->grupo; 

    echo '<br/>';

}



// Ahora si queremos consultar a un solo usuario con ID $x:

$db->setQuery("SELECT nombre`,`grupo` FROM `usuarios` WHERE `id`={$x}");



// loadObject()  nos regresara la primera (y única) fila del resultado

// en modo de objeto.

$u = $db->loadObject();

// Mostramos el resultado.

echo 'El usuario con ID '.$x.' se llama '.$u->nombre.' y está en el grupo '.$u->grupo.



// Si queremos borrar al usuario con ID $w

$db->setQuery("DELETE FROM `usuarios` WHERE `id` = {$w}");

// Lo ejecutamos

if($db->alter()){

    echo "El usuario {$w} fue eliminado.";

}

else{

    echo 'Error: '.$db->getError();

}



// Si queremos mostrar cuantas consultas hemos realizado:

echo 'Se ejecutaron '.$db->getTotalQueries().' operaciones SQL';



// O cuáles fueron las consultas:

$queries = $db->getSQLQueries(), $i = 1;

foreach($queries as $query){

    echo $i++ .' : '. $query . '<br/>';

}

*/



?>