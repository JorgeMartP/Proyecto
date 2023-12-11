<?php 
    if(!isset($_GET['codigo'])){
        header('Location: index_empleado.php?mensaje=error');
        exit();
    }

    include 'conexion/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("DELETE FROM empleado where identificacionE = ?;");
    $resultado = $sentencia->execute([$codigo]);

    if ($resultado === TRUE) {
        header('Location: index_empleado.php?mensaje=eliminado');
    } else {
        header('Location: index_empleado.php?mensaje=error');
    }
    
?>