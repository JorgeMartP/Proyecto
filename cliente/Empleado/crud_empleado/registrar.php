<?php
    #print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtIdentificacion"]) || empty($_POST["selectTipoIdentificacion"]) 
      || empty($_POST["txtEstadoCivil"]) || empty($_POST["txtNombre1"]) || empty($_POST["txtApellido1"])
      || empty($_POST["txtTelefono1"])|| empty($_POST["fechaNacimiento"]) || empty($_POST["txtDireccion"])
      || empty($_POST["fechaExpedicion"]) || empty($_POST["txtCorreo1"]) ){

        header('Location: index.php?mensaje=falta');
        exit();
    }

    include_once 'conexion/conexion.php';

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
    
    
    $sentencia = $bd->prepare("INSERT INTO empleado(identificacionE, tipoDocumento,estadoCivil,nombre1,nombre2,apellido1,
    apellido2,telefono1,telefono2,fechaNacimiento,direccion,fechaExpedicion,correo1,correo2) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);");

    $resultado = $sentencia->execute([$identif,$tipoIdent,$estadoCiv,$nombre,$nombre2,$apellido,$apellido2,
    $telefono,$telefono2,$fechaNac,$direccion,$fechaExp,$correo,$correo2]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=registrado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
    
?>