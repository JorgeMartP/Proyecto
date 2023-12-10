<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/CSS/estiloform.css">
    <link rel="stylesheet" href="../assets/CSS/estiloNavbar.css">
    <link rel="stylesheet" href="http://localhost/proyectoSena/vistas/assets/plugins/SweetAlert/dist/sweetalert2.min.css">
</head>
<body>
<?php
define('PROYECTO_RUTA', '/xampp/htdocs/proyectoSena/');
include_once PROYECTO_RUTA . 'controlador/conexion.php';
## TRAER EL USUARIO A ACTUALIZAR ##
if(isset($_GET['idU'])){
    try {
        $idUsu = $_GET['idU'];
        $sql = "SELECT a.idUsuario, a.tipoDocumento, a.nombreU, a.apellidoU, a.correoU, a.contraseña, a.codTipoUsuario, b.nombreTipo FROM usuario a, tipoUsuario b WHERE a.codTipoUsuario = b.codTipoUsuario AND idUsuario = ?;";
        $result = $conectar->prepare($sql);
        $result->bindValue(1, $idUsu);
        $result->execute();
    } catch (PDOException $e) {
        echo "Error en la base de datos". $e;
    }
}
function actualizar($identificacion, $tipo, $nombreU, $apellidoU, $correoU, $contraseña, $tipoUsuario){
    include('/xampp/htdocs/proyectoSena/controlador/conexion.php');
    try {
        $sql = "UPDATE usuario SET idUsuario = ?, tipoDocumento = ?, nombreU = ?, apellidoU = ?, correoU = ?, contraseña = ?, codTipoUsuario = ? WHERE idUsuario = ?;";
        $idUsu = $_GET['idU'];
        $result = $conectar->prepare($sql);
        $result->bindValue(1, $identificacion);
        $result->bindValue(2, $tipo);
        $result->bindValue(3, $nombreU);
        $result->bindValue(4, $apellidoU);
        $result->bindValue(5, $correoU);
        $result->bindValue(6, $contraseña);
        $result->bindValue(7, $tipoUsuario);
        $result->bindValue(8, $idUsu);
        $result->execute();
        if($result == true){
            echo '<script type="text/javascript">
            function mostrarAlertaYRedirigir() {
            Swal.fire({
                icon: "success",
                text: "Usuario actualizado correctamente"
            }).then(() => {
                window.location.href = "administrador.php";
            });
            }

            window.onload = mostrarAlertaYRedirigir;
            </script>';
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos". $e;
    }
}


if(isset($_POST['registrarUA'])){
    foreach($result AS $row){
        $identificacion = $_POST['numIdentificacion'];
        $tipo = $_POST['tipoU'];
        $nombreU = $_POST['nombreRU'];
        $apellidoU = $_POST['apellidoRU'];
        $correoU = $_POST['emailRU'];
        $contraseña = $_POST['contraseñaU'];
        $tipoUsuario = $_POST['tipoUsuarioU'];
        if($contraseña == $row['contraseña']){
            actualizar($identificacion,$tipo,$nombreU,$apellidoU,$correoU,$contraseña,$tipoUsuario);
        }else{
            $password = password_hash($contraseña, algo:PASSWORD_DEFAULT);
            actualizar($identificacion,$tipo,$nombreU,$apellidoU,$correoU,$password,$tipoUsuario);
        }
    }
}
?>
<section class="modal-actualizar">
        <div class="form signup">
                <span class="title">Actualizar Usuario</span>
            
                <form action="#" method="post">
                    <div class="input-field">
                        <?php foreach($result AS $row){?>
                        <input type="number" placeholder="N° Identificación" value="<?= $row['idUsuario']?>" name="numIdentificacion" required>
                        <i class='bx bxs-id-card icon'></i>
                    </div>
                    <div class="input-field">
                        <select name="tipoU" id="" required>
                            <option value="<?= $row['tipoDocumento'] ?>"><?= $row['tipoDocumento'] ?></option>
                            <option value="CC">CC</option>
                            <option value="TI">TI</option>
                            <option value="CE">CE</option>
                        </select>
                        <i class='bx bxs-id-card icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Nombre" value="<?= $row['nombreU'] ?>" name="nombreRU" required>
                        <i class='bx bx-user icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Apellido" value="<?= $row['apellidoU'] ?>" name="apellidoRU" required>
                        <i class='bx bx-user icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="email" placeholder="Correo Electronico" value="<?= $row['correoU'] ?>" name="emailRU" required>
                        <i class='bx bx-envelope icon'></i>
                    </div>
                    <div class="input-field">
                        <div class="tooltip">
                        <h4>La contraseña debe cumplir con: </h4>
                            <ul>
                                <li>Al menos 8 caracteres</li>
                                <li>Al menos un número</li>
                                <li>Al menos una letra minúscula</li>
                                <li>Al menos una letra mayúscula</li>
                                <li>Al menos un carácter especial</li>
                            </ul>
                        </div>
                        <input type="password" placeholder="Contraseña"  value="<?= $row['contraseña'] ?>" name="contraseñaU"  class="password" id="password" required>
                        <i class='bx bx-lock-alt icon' id="icon"></i>
                        <i class='bx bx-hide showHipePw' id="icon2"></i>
                        <p id="massage">La contraseña es <span id="strenght"></span></p>
                    </div>
                    <div class="input-field">
                        <select name="tipoUsuarioU" id="" required>
                            <option value="<?= $row['codTipoUsuario'] ?>"><?= $row['nombreTipo']?></option>
                            <option value="1">Jefe RH</option>
                            <option value="2">Contador</option>
                            <option value="3">Administrador</option>
                        </select>
                        <?php } ?>
                        <i class='bx bx-user icon'></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" value="Actualizar" name="registrarUA">
                    </div>
                    
                </form>
            </div>
        </section>
<script src="http://localhost/proyectoSena/vistas/assets/js/modal.js"></script>
<script src="http://localhost/proyectoSena/vistas/assets/js/sweet.js"></script>
<script src="http://localhost/proyectoSena/vistas/assets/js/script2.js"></script>
<script src="http://localhost/proyectoSena/vistas/assets/js/script.js"></script>
<script src="http://localhost/proyectoSena/vistas/assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</body>
</html>