<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index_parientes.php?mensaje=error');
    }

    include 'conexion/conexion.php';

    $identif = $_POST["txtIdentificacion"];
    $tipoIdent = $_POST["selectTipoIdentificacion"];
    $nombre = $_POST["txtNombre1"];
    $nombre2 = $_POST["txtNombre2"];
    $apellido1 = $_POST["txtApellido1"];
    $apellido2 = $_POST["txtApellido2"];
    $correo = $_POST["txtCorreo"];
    $fechaNac = $_POST["fechaNacimiento"];
    $parentesco = $_POST["txtParentesco"];
    $telefono1 = $_POST["txtTelefono1"];
    $telefono2 = $_POST["txtTelefono2"];
    $identificacion_empleado = $_POST["txtIdentificacionEmpleado"];
   

    $sentencia = $bd->prepare("UPDATE parientes SET tipoDocumento = ?, nombre1= ?, nombre2 = ?, apellido1 = ?,
    apellido2 = ?, correo = ?, fechaNacimiento = ?, parentesco = ?, telefono1 = ?, telefono2 = ?, identificacionE = ? WHERE identificacionP = ?;");
    
    $resultado = $sentencia->execute([$tipoIdent,$nombre,$nombre2,$apellido1,$apellido2,
    $correo,$fechaNac,$parentesco,$telefono1,$telefono2,$identificacion_empleado, $identif]);

    if ($resultado === TRUE) {
        header('Location: index_parientes.php?mensaje=editado');
    } else {
        header('Location: index_parientes.php?mensaje=error');
        exit();
    }
    
?>