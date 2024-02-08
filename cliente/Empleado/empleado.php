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
    if($_SESSION['rol'] != 1){
        header("Location: ../Usuario/inicioSesion.php");
        exit();
    }
}
$empresa = $_SESSION['empresa'];

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
        $sql = "SELECT * FROM empleado WHERE nit = '$empresa'";
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
                    <?php echo '<a href="RegistrarEmpleado.php">';?>
                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <span class="title">Registrar Empleado</span>
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
                <img src="../assets/img/perfil.jpg" alt="perfil">
            </div>
        </div>
        <div class="container_Table">
            <h2>Empleados registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach($result AS $row){ ?>
                    <tr>
                        <th><?= $row['identificacionE'] ?></th>
                        <th><?= $row['tipoDocumento'] ?></th>
                        <th><?= $row['nombre1'] ?></th>
                        <th><?= $row['apellido1'] ?></th>
                        <th><?= $row['correo1'] ?></th>
                        <th><?= $row['telefono1'] ?></th>
                        <th><a href="actualizarEmpleado.php?idU=<?= $row['identificacionE'];?>" class="users-table--edit"><i class='bx bx-show'></i></a></th>
                    </tr>
                <?php } ?>
            </tbody>
            </table>    
        </div>
<script>
    setTimeout(()=>{
        window.history.replaceState(null,null,window.location.pathname);
    },0)
</script>
<script src="http://localhost/Proyecto/cliente/assets/js/modal.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/js/sweet.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/js/script2.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/js/script.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</body>
</html>