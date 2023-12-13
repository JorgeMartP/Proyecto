<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccion Empresa</title>
    <link rel="stylesheet" href="../assets/CSS/estiloCard.css">
</head>

<!-- Traer el todas las empresas-->
<?php
define('PROYECTO_RUTA', '/xampp/htdocs/Proyecto/');
include_once PROYECTO_RUTA . 'servidor/conexion.php';
session_start();
echo "Rol: " . $_SESSION['rol'];

try {
    $sql = "SELECT * FROM empresa;";
    $resultado = $conectar->prepare($sql);
    $resultado->execute();
    $numero_registro = $resultado->rowCount();
} catch (PDOException $e) {
    echo "Error en la base de datos". $e;
}

?>
<body>
    <div class="container">
        <h1 class="heading">Elige una empresa</h1>
        <div class="box-container">
            <?php
            
            if($numero_registro != 0){
                
                foreach ($resultado as $row){
                ?>
                <div class="box">
                <img src="../assets/img/klipartz.com.png" alt="Empresa">
                <h3><?=$row['nombreEmpresa']?></h3>
                <p><span>Nit: </span><?=$row['nit']?></p>
                <p><span>Dirección: </span><?=$row['direccionE']?></p>
                <p><span>Teléfono: </span><?=$row['telefono']?></p>
                <?php
                if($_SESSION['rol'] == 1){
                    echo '<a href="../Empleado/consultaEmpleado.php?empresa=' . $row['nit'] . '">Ingresar</a>';
                    
                }else{
                    echo '<a href="../Empleado.php?empresa=' . $row['nit'] . '">Ingresar</a>';
                } ?>
            </div>
            <?php
            }}
            
            ?>
        </div>
    </div>
</body>
</html>