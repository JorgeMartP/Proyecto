<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/CSS/estiloInicioSesion.css">
    <link rel="stylesheet" href="http://localhost/Proyecto/cliente/assets/plugins/SweetAlert/dist/sweetalert2.min.css">
</head>

<?php
define('PROYECTO_RUTA', '/xampp/htdocs/Proyecto/');
include_once PROYECTO_RUTA . 'servidor/conexion.php';


#INICIAMOS LA SESION 
session_start();
#VERIFICAMOS QUE SI EXISTE LA VARIABLE CERRAR_SESION SI EXISTE CERRAMOS LA SESION ACTUAL Y ELIMINAMOS LAS COOKIES 
if (isset($_GET['cerrar_sesion'])) {
    setcookie("cookiesRol", "jorgelm65@gmail.com", time()-1);
    setcookie("cookiesId", "1232323", time()-1);
    session_unset();
    session_destroy();
    header("Location: inicioSesion.php");
    exit();
}
#VERIFICAMOS QUE ROL TIENE EL USUARIO INGRESADO Y LO ENVIAMOS A LA PAGINA DESEADA
function sesion($sesion){
    switch($sesion){
        case 1:
            header("Location: selectEmpresa.php");
            break;
        case 2:
            header("Location: selectEmpresa.php");
            break;
        case 3:
            header("Location: administrador.php");
            break;
        default:
    }
}

#VERIFICAMOS SI EXISTE UNA SESION O UNA COOKIE Y ENVIAMOS A LA FUNCION SESION() CON EL NUMERO DEL ROL DEL USUARIO 
if (isset($_SESSION["rol"]) || isset($_COOKIE["cookiesRol"])) {
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
        sesion($rol);
    }else{
        $_SESSION['rol'] = $_COOKIE['cookiesRol'];
        $_SESSION['idUsuario'] = $_COOKIE['cookiesId'];
        $rolC = $_COOKIE['cookiesRol'];
        sesion($rolC);
    }
    
}
?>
<body>
<?php
###  INICIAR SESION  ###
if(isset($_POST["login"])){
    #OBTENGO LOS DATOS ENVIADOS EN EL FORMULARIO DE INICIO SESION Y HAGO LA CONSULTA DE SI EL USUARIO EXISTE
    try {
    $contraseña_L = $_POST["contraseña_Login"];
    $documento = $_POST["numDocumento"];
    $sql = "SELECT * FROM usuario WHERE idUsuario = $documento;";
    $res = $conectar->prepare($sql);
    $res->execute();
    $numero_registro = $res->rowCount();
    #SI EXISTE EL USUARIO COMPARO LO INGRESADO POR EL USUARIO CON LO QUE HAY EN LA BASE DE DATOS
    if ($numero_registro != 0) {
        foreach ($res as $row) {
            if(isset($_POST["recordar"])){
                setcookie("cookiesRol", $row['codTipoUsuario'], time()+259200);
                setcookie("cookiesId", $row['idUsuario'], time()+259200 );
            }
            if (password_verify($contraseña_L, $row['contraseña']) && $documento == $row['idUsuario']) {
                $_SESSION['rol'] = $row['codTipoUsuario'];
                $_SESSION['idUsuario'] = $row['idUsuario'];
                sesion($_SESSION['rol']);
            ## SI LO INGRESADO POR EL USUARIO NO COICIDEN CON LO QUE HAY EN LA BASE DE DATOS LE INFORMACION QUE LOS DATOS ESTAN INCORRECTOS
            } else {
                echo '<script type="text/javascript">
                function miFuncion() {
                Swal.fire({
                    icon: "warning",
                    text: "Contraseña o Usuario incorrectos  intente nuevamente"
                })
            }
            window.onload = miFuncion;
            </script>';
            }
        }
    #SI EL USUARIO NO EXISTE EN LA BASE DE DATOS LE INFORMACION QUE LO TIENEN QUE REGISTRAR##
    } else{
        echo '<script type="text/javascript">
        function miFuncion() {
        Swal.fire({
            icon: "warning",
            text: "Usuario no registrado. Pidele al administrador que te registre"
        })
        }
        window.onload = miFuncion;
        </script>';
    }
}catch(PDOException $e){
    echo '<script type="text/javascript">
            function miFuncion() {
            Swal.fire({
                icon: "warning",
                text: "Error en la base de datos"
            })
            }
            window.onload = miFuncion;
            </script>';
}
}


    ?>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Iniciar Sesión</span>
            
                <form action="#" method="post">
                    <div class="input-field">
                        <input type="number" placeholder="N° Documento" name="numDocumento" required>
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
                        <input type="password" placeholder="Contraseña" name="contraseña_Login" class="password" required>
                        <i class='bx bx-lock-alt icon'></i>
                        <i class='bx bx-hide showHipePw'></i>
                    </div>
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" name="recordar" id="logCheck">
                            <label for="logCheck" class="text">¿Recordar Usuario?</label>
                        </div>
                    </div>
                    <div class="input-field button">
                        <input type="submit" value="Iniciar Sesión" name="login">
                    </div>
                </form>
            </div>
            </div>


        </div>
    </div>
</body>
</html>
<script>
    setTimeout(()=>{
        window.history.replaceState(null,null,window.location.pathname);
    },0)
</script>
<script src="http://localhost/Proyecto/cliente/assets/js/script.js"></script>
    
    <script src="http://localhost/Proyecto/cliente/assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</body>
</html>