<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'conexion/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("SELECT * FROM parientes WHERE identificacionP = ?;");
    $sentencia->execute([$codigo]);
    $persona = $sentencia->fetch(PDO::FETCH_OBJ);
    #print_r($persona);

    
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Identificación: </label>
                        <input type="text" class="form-control" name="txtIdentificacion" required 
                        value="<?php echo $persona->identificacionP; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo Identificación: </label>
                        <select class="form-select" name="selectTipoIdentificacion" required 
                        value="<?php echo $persona->tipoDocumento; ?>">
                            <option value="">Seleccionar</option> 
                            <option value="c.c">Cédula de Ciudadanía (C.C.)</option>
                            <option value="t.i">Tarjeta de Identidad (T.I.)</option>
                            <option value="c.e">Cédula de Extranjería (C.E.)</option>                    
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre 1: </label>
                        <input type="text" class="form-control" name="txtNombre1" required 
                        value="<?php echo $persona->nombre1; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre 2 (opcional): </label>
                        <input type="text" class="form-control" name="txtNombre2"
                            value="<?php echo $persona->nombre2; ?>">
                    </div> 
                    
                    <div class="mb-3">
                        <label class="form-label">Apellido 1: </label>
                        <input type="text" class="form-control" name="txtApellido1" required 
                        value="<?php echo $persona->apellido1; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido 2 (opcional): </label>
                        <input type="text" class="form-control" name="txtApellido2"  
                        value="<?php echo $persona->apellido2; ?>">
                    </div>    

                    <div class="mb-3">
                        <label class="form-label">Correo: </label>
                        <input type="email" class="form-control" name="txtCorreo" required 
                        value="<?php echo $persona->correo; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha Nacimiento: </label>
                        <input type="date" class="form-control" name="fechaNacimiento" required 
                        value="<?php echo $persona->fechaNacimiento; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parentesco: </label>
                        <input type="text" class="form-control" name="txtParentesco"  
                        value="<?php echo $persona->parentesco; ?>">
                    </div>    

                    <div class="mb-3">
                        <label class="form-label">Telefono 1: </label>
                        <input type="text" class="form-control" name="txtTelefono1" required 
                        value="<?php echo $persona->telefono1; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Telefono 2 (opcional): </label>
                        <input type="text" class="form-control" name="txtTelefono2" 
                        value="<?php echo $persona->telefono2; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Identificación Empleado: </label>
                        <input type="text" class="form-control" name="txtIdentificacionEmpleado" required 
                        value="<?php echo $persona->identificacionE; ?>">
                    </div>                

                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $persona->codigo; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>