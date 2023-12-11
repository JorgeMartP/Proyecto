<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Empleados</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/CSS/estiloNavbar.css">
    <link rel="stylesheet" href="../assets/CSS/estiloform.css">
    <link rel="stylesheet" href="http://localhost/Proyecto/cliente/assets/plugins/SweetAlert/dist/sweetalert2.min.css">
</head>
<body>
<?php
define('PROYECTO_RUTA', '/xampp/htdocs/Proyecto/');
include_once PROYECTO_RUTA . 'servidor/conexion.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: ../Usuario/inicioSesion.php");
    exit();
}else{
    if($_SESSION['rol'] != 2){
        header("Location: ../Usuario/inicioSesion.php");
        exit();
    }
}


if(isset($_GET['buscar'])){
    try{
        $buscar = $_GET['buscar'];
        $sql = "SELECT * FROM empleado WHERE identificacionE  LIKE '%$buscar%'";
        $result = $conectar->prepare($sql);
        $result->execute();
    }catch (PDOException $e){

    }
    
}else{
    try {
        $sql = "SELECT * FROM empleado";
        $result = $conectar->prepare($sql);
        $result->execute();
    } catch (PDOException $e) {
        echo "Error en la base de datos". $e;
    }
    
}

$idUs = $_SESSION['idUsuario'];
try {
    $sql = "SELECT * FROM usuario WHERE idUsuario = $idUs";
    $res = $conectar->prepare($sql);
    $res->execute();
} catch (PDOException $e) {
    echo "Error en la base de datos". $e;
}
?>
<div class="container">
        <div class="navegacion">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bxs-briefcase'></i></span>
                        <?php foreach($res AS $row){?>
                        <span class="title"><?=$row['nombreU'] ." ". $row['apellidoU']?></span>
                        <?php }?>
                    </a>
                    
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bxs-home'></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bxs-cog' ></i></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="../Usuario/inicioSesion.php?cerrar_sesion=true">
                        <span class="icon"><i class='bx bx-exit' ></i></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <i class='bx bx-menu'></i>
            </div>
            <div class="search">
                <label>
                    <form action="#" method="get">
                    <input type="text" name="buscar" placeholder="Buscar">
                    <Button type="submit"><i class='bx bx-search-alt-2' ></i></Button>
                    </form>
                </label>
            </div>
            <div class="user">
                <img src="../perfil.jpg" alt="perfil">
            </div>
        </div>
        <div class="container_Table">
            <h2>Usuarios registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach($result AS $row){ ?>
                    <tr>
                        <th><?= $row['idUsuario'] ?></th>
                        <th><?= $row['tipoDocumento'] ?></th>
                        <th><?= $row['nombreU'] ?></th>
                        <th><?= $row['apellidoU'] ?></th>
                        <th><?= $row['correoU'] ?></th>
                        <th><?= $row['nombreTipo'] ?></th>
                        <th><a href="ConsultarEmpleado.php?idU=<?= $row['idUsuario'];?>" class="users-table--edit"><i class='bx bx-edit' ></i></a></th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        </div>
</body>
</html>