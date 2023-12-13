
<?php
$host="localhost";
$user="root";
$pass="";
$base="nomina";
try{
    $cadena ="mysql:host=".$host.";dbname=".$base.";setcharset=utf8";
    $conectar=new PDO($cadena,$user,$pass);
    $conectar->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
}catch(Exception $e){
    $conectar="Error en la conexion a la base de datos";
    echo "Atencion! se encontro un error en la conexion". $e;
    }

?>
