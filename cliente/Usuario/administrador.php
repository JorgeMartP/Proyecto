<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Empleado</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/CSS/estiloNavbar.css">
    <link rel="stylesheet" href="../assets/CSS/estiloform.css">
    <link rel="stylesheet" href="http://localhost/Proyecto/cliente/assets/plugins/SweetAlert/dist/sweetalert2.min.css">
</head>

<?php
define('PROYECTO_RUTA', '/xampp/htdocs/proyectoSena/');
include_once PROYECTO_RUTA . 'servidor/conexion.php';
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: inicioSesion.php");
    exit();
}else{
    if($_SESSION['rol'] != 3){
        header("Location: inicioSesion.php");
        exit();
    }
}
## ELIMINAR USUARIO ###

if(isset($_GET['id'])){
    $idUsuario = $_GET['id'];
    try{
        $sql = "DELETE FROM usuario WHERE idUsuario = '$idUsuario';";
        $resultado = $conectar->prepare($sql);
        $resultado->execute();
        if($resultado == true){
            echo '<script type="text/javascript">
                    function mostrarAlertaYRecargar() {
                    Swal.fire({
                        icon: "success",
                        text: "Usuario eliminado Correctamente"
                }).then(() => {
                    location.reload(); 
                });
                }

                window.onload = mostrarAlertaYRecargar;
                </script>';
        }
    }catch (PDOException $e){
        echo '<script type="text/javascript">
    function mostrarAlerta() {
        Swal.fire({
            icon: "warning",
            title: "Error en el registro",
            text: " El usuario no se puede eliminar"
        });
    }

    window.onload = mostrarAlerta;
</script>';
    }
}
function validar_clave($clave,&$error_clave){
    if(strlen($clave)< 6){
        $error_clave = "La contraseña debe tener al menos 6 caracteres";
        return false;
    }
    if(strlen($clave)>16){
        $error_clave = "La contraseña no puede tener más de 16 caracteres";
        return false;
    }
    if(!preg_match('`[a-z]`', $clave)){
        $error_clave = "La contraseña debe tener al menos una letra minúscula";
        return false;
    }
    if(!preg_match('`[A-Z]`', $clave)){
        $error_clave = "La contraseña debe tener al menos una letra mayuscula";
        return false;
    }
    if (!preg_match('`[0-9]`', $clave)){
        $error_clave = "La contraseña debe tener al menos un caracter numérico";
        return false;
    }
    if (!preg_match('#[@$%^&*()_+\-=\[\]{};\'":<>,./?\\|`~]#', $clave)) {
        $error_clave = "La contraseña debe tener al menos un carácter especial";
        return false;
    }
    $error_clave = "";
    return true;
}
#TRAER TODOS LOS USUARIO DE LA BASE DE DATOS##
try {
    $sql = "SELECT a.idUsuario, a.nombreU, a.apellidoU, a.correoU, a.contraseña, a.codTipoUsuario, b.nombreTipo FROM usuario a, tipoUsuario b WHERE a.codTipoUsuario = b.codTipoUsuario;";
    $resultado = $conectar->prepare($sql);
    $resultado->execute();
} catch (PDOException $e) {
    echo "Error en la base de datos". $e;
}

## TRAER EL USUARIO QUE INICIO SESION ##
$idUs = $_SESSION['idUsuario'];
try {
    $sql = "SELECT * FROM usuario WHERE idUsuario = $idUs";
    $res = $conectar->prepare($sql);
    $res->execute();
} catch (PDOException $e) {
    echo "Error en la base de datos". $e;
}

### REGISTRAR USUARIO  ###
if(isset($_POST["registrar"])){
    $error_encontrado="";
    if(validar_clave($_POST["contraseñaR"], $error_encontrado)){
        $numIde = htmlentities(addslashes($_POST['numIdentificacion']));
        $tipo = htmlentities(addslashes($_POST['tipo']));
        $nombre = htmlentities(addslashes($_POST['nombreR']));
        $apellido = htmlentities(addslashes($_POST['apellidoR']));
        $email = htmlentities(addslashes($_POST['emailR']));
        $contraseña = ($_POST['contraseñaR']);
        $password = password_hash($contraseña, algo:PASSWORD_DEFAULT);
        $tipoUsuario = htmlentities(addslashes($_POST['tipoUsuario']));
        try {
            $sql = "INSERT INTO usuario(idUsuario, tipoDocumento, nombreU, apellidoU, correoU, contraseña, codTipoUsuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $resultado = $conectar->prepare($sql);
            $resultado->bindValue(1, $numIde);
            $resultado->bindValue(2, $tipo);
            $resultado->bindValue(3, $nombre);
            $resultado->bindValue(4, $apellido);
            $resultado->bindValue(5, $email);
            $resultado->bindValue(6, $password);
            $resultado->bindValue(7, $tipoUsuario);
            $resultado->execute();
            if($resultado == true){
                echo '<script type="text/javascript">
                        function mostrarAlertaYRecargar() {
                        Swal.fire({
                            icon: "success",
                            text: "Usuario registrado Correctamente"
                    }).then(() => {
                        location.reload(); 
                    });
                    }

                    window.onload = mostrarAlertaYRecargar;
                    </script>';
            }
        } catch (PDOException $e) {
            echo '<script type="text/javascript">
            function miFuncion() {
            Swal.fire({
                icon: "warning",
                text: "Usuario ya registrado"
            })
        }
        window.onload = miFuncion;
        </script>';
        }
        
        
    }else{
        echo '<script type="text/javascript">
            function miFuncion() {
            Swal.fire({
                icon: "warning",
                text: "'.$error_encontrado.'"
            })
        }
        window.onload = miFuncion;
        </script>';
    }
}
?>
<body>
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
                    <a href="inicioSesion.php?cerrar_sesion=true">
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
                    <input type="text" name="" placeholder="Buscar">
                    <i class='bx bx-search-alt-2' ></i>
                </label>
            </div>
            <div class="user">
                <img src="../perfil.jpg" alt="perfil">
            </div>
        </div>
        <div class="crearUsuario">
        <div><h2>Usuarios</h2></div>
        <div><button class="btn-newUser"><i class='bx bxs-user-plus'></i> Crear Usuario</button></div>
        </div>
        <div class="container_Table">
            <h2>Usuarios registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Tipo Usuario</th>
                        <th></th>
                        <th></th>
                    </tr>
            </thead>
            <tbody>
                
                <?php foreach($resultado AS $row){ ?>
                    <tr>
                        <th><?= $row['idUsuario'] ?></th>
                        <th><?= $row['nombreU'] ?></th>
                        <th><?= $row['apellidoU'] ?></th>
                        <th><?= $row['correoU'] ?></th>
                        <th><?= $row['nombreTipo'] ?></th>
                        <th><a href="actualizarUsuario.php?idU=<?= $row['idUsuario'];?>" class="users-table--edit"><i class='bx bx-edit' ></i></a></th>
                        <th><a href="administrador.php?id=<?= $row['idUsuario'];?>" onclick="advertencia(event)" class="users-table--delete"><i class='bx bxs-trash'></i></a></th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        </div>
        <section class="modal">
        <div class="form signup">
                <a href="#" class="modalClose"><i class='bx bxs-x-circle'></i></a>
                <span class="title">Registrar Usuario</span>
            
                <form action="#" method="post">
                    <div class="input-field">
                        <input type="number" placeholder="N° Identificación" name="numIdentificacion" required>
                        <i class='bx bxs-id-card icon'></i>
                    </div>
                    <div class="input-field">
                        <select name="tipo" id="" required>
                            <option value="">Elige Tipo Identificación</option>
                            <option value="CC">CC</option>
                            <option value="TI">TI</option>
                            <option value="CE">CE</option>
                        </select>
                        <i class='bx bxs-id-card icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Nombre" name="nombreR" required>
                        <i class='bx bx-user icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Apellido" name="apellidoR" required>
                        <i class='bx bx-user icon'></i>
                    </div>
                    <div class="input-field">
                        <input type="email" placeholder="Correo Electronico" name="emailR" required>
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
                        <input type="password" placeholder="Contraseña" name="contraseñaR"  class="password" id="password" required>
                        <i class='bx bx-lock-alt icon' id="icon"></i>
                        <i class='bx bx-hide showHipePw' id="icon2"></i>
                        <p id="massage">La contraseña es <span id="strenght"></span></p>
                    </div>
                    <div class="input-field">
                        <select name="tipoUsuario" id="" required>
                            <option value="">Elige Tipo Usuario</option>
                            <option value="1">Jefe RH</option>
                            <option value="2">Contador</option>
                            <option value="3">Administrador</option>
                        </select>
                        <i class='bx bx-user icon'></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" value="Registrar" name="registrar">
                    </div>
                    
                </form>
            </div>
            </section>
    </div>
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