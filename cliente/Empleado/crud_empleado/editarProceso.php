<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'conexion/conexion.php';

    $identif = $_POST["txtIdentificacion"];
    $tipoIdent = $_POST["selectTipoIdentificacion"];
    $estadoCiv = $_POST["txtEstadoCivil"];
    $nombre = $_POST["txtNombre1"];
    $nombre2 = $_POST["txtNombre2"];
    $apellido = $_POST["txtApellido1"];
    $apellido2 = $_POST["txtApellido2"];
    $telefono = $_POST["txtTelefono1"];
    $telefono2 = $_POST["txtTelefono2"];
    $fechaNac = $_POST["fechaNacimiento"];
    $direccion = $_POST["txtDireccion"];
    $fechaExp = $_POST["fechaExpedicion"];
    $correo = $_POST["txtCorreo1"];
    $correo2 = $_POST["txtCorreo2"];

    $sentencia = $bd->prepare("UPDATE empleado SET tipoDocumento = ?, estadoCivil = ?, 
    nombre1 = ?, nombre2 = ?, apellido1 = ?, apellido2 = ?, telefono1 = ?, telefono2 = ?, 
    fechaNacimiento = ?, direccion = ?, fechaExpedicion = ?, correo1 = ?, correo2 = ?
    WHERE identificacionE = ?;");


    $resultado = $sentencia->execute([$tipoIdent, $estadoCiv, $nombre, $nombre2, $apellido, $apellido2,
    $telefono, $telefono2, $fechaNac, $direccion, $fechaExp, $correo, $correo2, $identif]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
    
?>