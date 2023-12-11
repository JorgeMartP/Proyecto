<?php
    #print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["txtIdentificacion"]) || empty($_POST["selectTipoIdentificacion"]) 
      || empty($_POST["txtNombre1"]) || empty($_POST["txtApellido1"])
      || empty($_POST["txtCorreo"])|| empty($_POST["fechaNacimiento"]) || empty($_POST["txtParentesco"])
      || empty($_POST["txtTelefono1"]) || empty($_POST["txtIdentificacionEmpleado"]) ){

        header('Location: index.php?mensaje=falta');
        exit();
    }

    include_once 'conexion/conexion.php';

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
    $identificacion_empleado = $_POST["txtIdentificacionEmpleado"]
    
    
    $sentencia = $bd->prepare("INSERT INTO parientes(`identificacionP`, `tipoDocumento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `correo`, `fechaNacimiento`, `parentesco`, `telefono1`, `telefono2`, `identificacionE`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?");

    $resultado = $sentencia->execute([$identif,$tipoIdent,$nombre,$nombre2,$apellido1,$apellido2,
    $correo,$fechaNac,$parentesco,$telefono1,$telefono2,$identificacion_empleado]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=registrado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
    
?>