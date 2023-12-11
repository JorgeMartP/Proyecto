<?php include 'template/header.php' ?>


<?php
    include_once "conexion/conexion.php";
    $sentencia = $bd -> query("select * from parientes");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
    #print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            
            <div class="card">
                <div class="card-header">
                    Lista de personas
                </div>
                <div class="p-2" style="overflow-x: auto;">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                
                                <th scope="col">Identificación</th>
                                <th scope="col">Tipo Identificación</th>
                                <th scope="col">Nombre 1</th>
                                <th scope="col">Nombre 2</th>
                                <th scope="col">Apellido 1</th>
                                <th scope="col">Apellido 2</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">parentesco</th>
                                <th scope="col">Telefono 1</th>
                                <th scope="col">Telefono 2</th>
                                <th scope="col">Identificación Empleado</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($persona as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->identificacionP; ?></td>
                                <td><?php echo $dato->tipoDocumento; ?></td>
                                <td><?php echo $dato->nombre1; ?></td>
                                <td><?php echo $dato->nombre2; ?></td>
                                <td><?php echo $dato->apellido1; ?></td>
                                <td><?php echo $dato->apellido2; ?></td>
                                <td><?php echo $dato->correo; ?></td>
                                <td><?php echo $dato->fechaNacimiento; ?></td>
                                <td><?php echo $dato->parentesco; ?></td>
                                <td><?php echo $dato->telefono1; ?></td>
                                <td><?php echo $dato->telefono2; ?></td>
                                <td><?php echo $dato->identificacionE;?></td>
                                <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->identificacionP; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->identificacionP; ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
             
            <div class="card">
                <div class="card-header">
                    Ingresar datos:

                </div>
                <form class="p-4" method="POST" action="registrar.php">   

                    <div class="mb-3">
                        <label class="form-label">Identificación: </label>
                        <input type="text" class="form-control" name="txtIdentificacion" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo Identificación: </label>
                        <select class="form-select" name="selectTipoIdentificacion" autofocus required>
                            <option value="">Seleccionar</option> 
                            <option value="c.c">Cédula de Ciudadanía (C.C.)</option>
                            <option value="t.i">Tarjeta de Identidad (T.I.)</option>
                            <option value="c.e">Cédula de Extranjería (C.E.)</option>                    
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre 1: </label>
                        <input type="text" class="form-control" name="txtNombre1" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre 2 (opcional): </label>
                        <input type="text" class="form-control" name="txtNombre2">
                    </div> 
                    
                    <div class="mb-3">
                        <label class="form-label">Apellido 1: </label>
                        <input type="text" class="form-control" name="txtApellido1" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido 2 (opcional): </label>
                        <input type="text" class="form-control" name="txtApellido2">
                    </div>    

                    <div class="mb-3">
                        <label class="form-label">Correo: </label>
                        <input type="email" class="form-control" name="txtCorreo" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha Nacimiento: </label>
                        <input type="date" class="form-control" name="fechaNacimiento" autofocus required>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Parentesco: </label>
                        <input type="text" class="form-control" name="txtParentesco" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefono 1: </label>
                        <input type="text" class="form-control" name="txtTelefono1" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefono 2 (opcional): </label>
                        <input type="text" class="form-control" name="txtTelefono2">
                    </div>             

                    <div class="mb-3">
                        <label class="form-label">Identificación Empleado: </label>
                        <input type="text" class="form-control" name="txtIdentificacionEmpleado">
                    </div>

                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>

                </form>

            </div>           
        </div>
    </div>
</div>

<?php 
include 'template/footer.php';
?>
