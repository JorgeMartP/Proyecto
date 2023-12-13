<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href=" /Proyecto/cliente/assets/CSS/estiloNavbar.css">
    <link rel="stylesheet" href=" /Proyecto/cliente/assets/CSS/estiloformE.css">
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
$departamentos = array(
    "Amazonas" => array("Leticia", "Puerto Nariño"),
    "Antioquia" => array("Medellín", "Bello", "Envigado", "Itagüí", "Sabaneta"),
    "Arauca" => array("Arauca", "Saravena", "Tame"),
    "Atlántico" => array("Barranquilla", "Soledad", "Malambo", "Puerto Colombia", "Galapa"),
    "Bogotá, D.C." => array("Bogotá"),
    "Bolívar" => array("Cartagena", "Bolívar", "Turbaná", "Arjona", "El Carmen de Bolívar"),
    "Boyacá" => array("Tunja", "Duitama", "Sogamoso", "Chiquinquirá", "Paipa"),
    "Caldas" => array("Manizales", "La Dorada", "Chinchiná", "Villamaría", "Aguadas"),
    "Caquetá" => array("Florencia", "Belén de los Andaquíes", "Puerto Rico", "San Vicente del Caguán"),
    "Casanare" => array("Yopal", "Villanueva", "Aguazul", "Tauramena", "Maní"),
    "Cauca" => array("Popayán", "Santander de Quilichao", "Patía", "Puerto Tejada", "Piendamó"),
    "Cesar" => array("Valledupar", "Aguachica", "Bosconia", "La Jagua de Ibirico", "Pailitas"),
    "Chocó" => array("Quibdó", "Nuquí", "Istmina", "Tadó", "Riosucio"),
    "Córdoba" => array("Montería", "Sincelejo", "Planeta Rica", "Tierralta", "Cereté"),
    "Cundinamarca" => array("Soacha", "Facatativá", "Girardot", "Zipaquirá", "Chía"),
    "Guainía" => array("Inírida"),
    "Guaviare" => array("San José del Guaviare"),
    "Huila" => array("Neiva", "Pitalito", "Garzón", "Campoalegre", "La Plata"),
    "La Guajira" => array("Riohacha", "Maicao", "Uribia", "Fonseca", "Manaure"),
    "Magdalena" => array("Santa Marta", "Ciénaga", "Fundación", "Plato", "Aracataca"),
    "Meta" => array("Villavicencio", "Acacías", "Granada", "Puerto López", "La Macarena"),
    "Nariño" => array("Pasto", "Tumaco", "Ipiales", "Túquerres", "La Unión"),
    "Norte de Santander" => array("Cúcuta", "Ocaña", "Pamplona", "Tibú", "Chinácota"),
    "Putumayo" => array("Mocoa", "Sibundoy", "Orito", "Villagarzón", "San Francisco"),
    "Quindío" => array("Armenia", "Calarcá", "Circasia", "Quimbaya", "Montenegro"),
    "Risaralda" => array("Pereira", "Dosquebradas", "La Virginia", "Santa Rosa de Cabal", "Belén de Umbría"),
    "San Andrés y Providencia" => array("San Andrés"),
    "Santander" => array("Bucaramanga", "Floridablanca", "Girón", "Piedecuesta", "Barrancabermeja"),
    "Sucre" => array("Sincelejo", "Corozal", "Sampués", "Morroa", "Colosó"),
    "Tolima" => array("Ibagué", "Espinal", "Melgar", "Chaparral", "Honda"),
    "Valle del Cauca" => array("Cali", "Buenaventura", "Palmira", "Yumbo", "Tuluá"),
    "Vaupés" => array("Mitú"),
    "Vichada" => array("Puerto Carreño", "La Primavera", "Cumaribo")
);
?>
<?php
if(isset($_POST['registrar'])){
    $empresa = 	$_GET['empresa'];

    $numDocumento = $_POST['numDoc'];
    $tipoDocumento = $_POST['tDocumento'];
    $fechaNacimiento = $_POST['fNacimiento'];
    $fechaExpedicion = $_POST['fExpedicion'];
    $nombreUno = $_POST['nombreUno'];
    $nombreDos = $_POST['nombreDos'];
    $apellidoUno = $_POST['ApellidoUno'];
    $apellidoDos = $_POST['ApellidoDos'];
    $estadoCivil = $_POST['eCivil'];
    $genero = $_POST['genero'];
    $nivelEstudio = $_POST['estudio'];
    $telefonoUno = $_POST['telefonoU'];
    $telefonoDos = $_POST['telefonoD'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $correoUno = $_POST['correoU'];
    $correoDos = $_POST['correoD'];
    $numContrato = $_POST['numContrato'];
    $tipoContrato = $_POST['tipoContrato'];
    $fechaIC = $_POST['fInicio'];
    $fechaFC = $_POST['fFinal'];
    $cargo = $_POST['cargos'];
    $salario = $_POST['salario'];
    $banco = $_POST['bancos'];
    $tipoCuenta = $_POST['tipoCuenta'];
    $numeroCuenta = $_POST['numCuenta'];
    try {
        $sql = "INSERT INTO empleado(identificacionE, tipoDocumento, fechaNacimiento, fechaExpedicion, nombre1, nombre2, apellido1, apellido2, estadoCivil, genero, nivelEstudio, telefono1, telefono2, departamento, ciudad, direccion, correo1, correo2, nit ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $res = $conectar->prepare($sql);
        $res->bindValue(1, $numDocumento);
        $res->bindValue(2, $tipoDocumento);
        $res->bindValue(3, $fechaNacimiento);
        $res->bindValue(4, $fechaExpedicion);
        $res->bindValue(5, $nombreUno);
        $res->bindValue(6, $nombreDos);
        $res->bindValue(7, $apellidoUno );
        $res->bindValue(8, $apellidoDos);
        $res->bindValue(9, $estadoCivil);
        $res->bindValue(10, $genero);
        $res->bindValue(11, $nivelEstudio);
        $res->bindValue(12, $telefonoUno);
        $res->bindValue(13, $telefonoDos );
        $res->bindValue(14, $departamento);
        $res->bindValue(15, $ciudad);
        $res->bindValue(16, $direccion);
        $res->bindValue(17, $correoUno);
        $res->bindValue(18, $correoDos);
        $res->bindValue(19, $empresa);
        $res->execute();
        
    } catch (PDOException $e) {
        echo "Error en la base de datos". $e;
    }


    try {
        $sql = "INSERT INTO contrato (codContrato, fechaInicio, fechaFin, codCargo, salario, codTipoContrato, identificacionE) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $resultado = $conectar->prepare($sql);
        $resultado->bindValue(1, $numContrato);
        $resultado->bindValue(2, $fechaIC );
        $resultado->bindValue(3, $fechaFC);
        $resultado->bindValue(4, $cargo);
        $resultado->bindValue(5, $salario);
        $resultado->bindValue(6, $tipoContrato);
        $resultado->bindValue(7, $numDocumento);
        $resultado->execute();
        
    } catch (PDOException $e) {
        echo "Error en la base de datos contrato". $e;
    }

    try {
        $sql = "INSERT INTO cuenta(numCuenta, codBanco, idTipoCuenta, identificacionE) VALUES (?, ?, ?, ?);";
        $result = $conectar->prepare($sql);
        $result->bindValue(1, $numeroCuenta);
        $result->bindValue(2, $banco);
        $result->bindValue(3, $tipoCuenta);
        $result->bindValue(4, $numDocumento);
        $result->execute();
        if($result == true){
            echo '<script type="text/javascript">
                        function mostrarAlertaYRecargar() {
                        Swal.fire({
                            icon: "success",
                            text: "Empleado registrado Correctamente"
                    }).then(() => {
                        location.reload(); 
                    });
                    }

                    window.onload = mostrarAlertaYRecargar;
                    </script>';
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos cuenta". $e;
    }
}
?>
<div class="container">
        <div class="navegacion">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bxs-briefcase'></i></span>
                        <span class="title"></span>
                    </a>
                    
                </li>
                <li>
                    <?php echo '<a href="empleado.php?empresa=' . $_GET['empresa'].'">';?>
                        <span class="icon"><i class='bx bxs-home'></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-cog' ></i></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="../Usuario/inicioSesion.php?cerrar_sesion=true">
                        <span class="icon"><i class='bx bx-log-out' ></i></span>
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
        <br><br>
        <div class="container-form">
            <header>Registro Empleado</header>
            <form action="#" method="post" class="form">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Informacion Personal</span>
                        <div class="fields">
                            <div class="input-field">
                                <label>Numero Documento <span>*</span></label>
                                <input type="number" name="numDoc" placeholder="1002332232" required>
                            </div>
                            <div class="input-field">
                                <label>Tipo Documento <span>*</span></label>
                                <select name="tDocumento" required>
                                    <option value="">Seleccione</option>
                                    <option value="Cedula">Cedula</option>
                                    <option value="T.Identidad">T. Identidad</option>
                                    <option value="Cedula Extranjeria">Cedula Extranjeria</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Fecha Nacimiento <span>*</span></label>
                                <input type="date" name="fNacimiento" required>
                            </div>
                            <div class="input-field">
                                <label>Fecha Expedición <span>*</span></label>
                                <input type="date" name="fExpedicion" required>
                            </div>
                            <div class="input-field">
                                <label>1° Nombre <span>*</span></label>
                                <input type="text" placeholder="Primer Nombre" name="nombreUno" required>
                            </div>
                            <div class="input-field">
                                <label>2° Nombre</label>
                                <input type="text" placeholder="Segundo Nombre" name="nombreDos">
                            </div>
                            <div class="input-field">
                                <label>1° Apellido <span>*</span></label>
                                <input type="text" placeholder="Primer Apellido" name="ApellidoUno" required>
                            </div>
                            <div class="input-field">
                                <label>2° Apellido</label>
                                <input type="text" placeholder="Segundo Apellido" name="ApellidoDos">
                            </div>
                            <div class="input-field">
                                <label>Estado Civil <span>*</span></label>
                                <select name="eCivil" required>
                                    <option value="">Seleccione</option>
                                    <option value="Soltero/a">Soltero/a</option>
                                    <option value="Casado/a">Casado/a</option>
                                    <option value="Viudo/a">Viudo/a</option>
                                    <option value="Union Libre">Union Libre</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Genero <span>*</span></label>
                                <select name="genero" required>
                                    <option value="">Seleccione</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="No binario">No binario</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Nivel Estudio<span>*</span></label>
                                <select name="estudio" required>
                                    <option value="">Seleccione</option>
                                    <option value="primaria">Primaria</option>
                                    <option value="secundaria">Secundaria</option>
                                    <option value="tecnico">Técnico</option>
                                    <option value="tecnologico">Tecnológico</option>
                                    <option value="pregrado">Pregrado/Universitario</option>
                                    <option value="postgrado">Postgrado</option>
                                    <option value="maestria">Maestría</option>
                                    <option value="doctorado">Doctorado</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>1° Telefono <span>*</span></label>
                                <input type="number" placeholder="3182332223" name="telefonoU">
                            </div>
                            <div class="input-field">
                                <label>2° Telefono</label>
                                <input type="number" placeholder="3182332223" name="telefonoD">
                            </div>
                            <div class="input-field">
                                <label>Departamento <span>*</span></label>
                                <select id="departamento" name="departamento" required>
                                    <option value="" selected>Selecciona un departamento</option>
                                    <?php
                                    foreach ($departamentos as $departamento => $ciudades) {
                                        echo "<option value='$departamento'>$departamento</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Ciudad <span>*</span></label>
                                <select id="ciudad" name="ciudad" disabled required>
                                    <option value="" selected>Selecciona un departamento primero</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Direccion<span>*</span></label>
                                <input type="text" placeholder="calle 33 # 22B - 122" name="direccion" required>
                            </div>
                            <div class="input-field">
                                <label>1° Correo<span>*</span></label>
                                <input type="email" placeholder="example@gmail.com" name="correoU" required>
                            </div>
                            <div class="input-field">
                                <label>2° Correo</label>
                                <input type="email" placeholder="example@gmail.com" name="correoD">
                            </div>
                            
                        </div>
                        <botton class="nextBtn">
                            <span class="btnText">Siguiente</span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </botton>
                    </div>
                </div>

                <div class="form second">
                    <div class="details personal">
                        <span class="title">Informacion de Contrato</span>
                        <div class="fields">
                            <div class="input-field">
                                <label>Numero De Contrato <span>*</span></label>
                                <input type="text" placeholder="" name="numContrato" required>
                            </div>
                            <div class="input-field">
                                <label>Tipo Contrato <span>*</span></label>
                                <select name="tipoContrato">
                                    <option value="1">Término indefinido</option>
                                    <option value="2">Término fijo</option>
                                    <option value="3">Obra o labor</option>
                                    <option value="4">Aprendizaje</option>
                                    <option value="5">Prestación de servicios</option>
                                    <option value="6">Por horas</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Fecha Inicio <span>*</span></label>
                                <input type="date" name="fInicio" required>
                            </div>
                            <div class="input-field">
                                <label>Fecha Final</label>
                                <input type="date" name="fFinal">
                            </div>
                            <div class="input-field">
                                <label>Cargo <span>*</span></label>
                                <select name="cargos" required>
                                    <option value="">Selecione</option>
                                    <option value="1">Gerente General</option>
                                    <option value="2">Director de Recursos Humanos</option>
                                    <option value="3">Analista de Sistemas</option>
                                    <option value="4">Asistente Administrativo</option>
                                    <option value="5">Especialista en Marketing</option>
                                    <option value="6">Técnico de Soporte Técnico</option>
                                    <option value="7">Contador</option>
                                    <option value="8">Ingeniero de Proyectos</option>
                                    <option value="9">Diseñador Gráfico</option>
                                    <option value="10">Asesor Comercial</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Salario <span>*</span></label>
                                <input type="number" placeholder="1160000" name="salario">
                            </div>
                        </div>
                    </div>

                    <div class="details personal">
                        <span class="title">Informacion Datos Bancarios</span>
                        <div class="fields">
                            <div class="input-field">
                                <label>Banco <span>*</span></label>
                                <select name="bancos">
                                    <option value="">Seleccione</option>
                                    <option value="1">Banco de Bogotá</option>
                                    <option value="2">Banco Popular</option>
                                    <option value="3">Banco AV Villas</option>
                                    <option value="4">Bancolombia</option>
                                    <option value="5">Banco Davivienda</option>
                                    <option value="6">Banco Caja Social</option>
                                    <option value="7">Banco Falabella</option>
                                    <option value="8">Banco Itaú</option>
                                    <option value="9">Banco Occidente</option>
                                    <option value="10">Banco Coomeva</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Tipo De Cuenta</label>
                                <select name="tipoCuenta">
                                    <option value="1">Ahorro</option>
                                    <option value="2">Corriente</option>
                                    <option value="3">Daviplata</option>
                                    <option value="5">Nequi</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Numero De Cuenta</label>
                                <input type="number" placeholder="9912339232" name="numCuenta">
                            </div>
                        </div>
                        <div class="buttons">
                            <div class="backBtn">
                                <i class='bx bx-left-arrow-alt'></i>
                                <span class="btnText">Retroceder</span>
                                
                            </div>
                            <div class="nextBtn">
                                <input type="submit" value="Registrar" name="registrar">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script>
    let toggle = document.querySelector('.toggle');
    let navegacion = document.querySelector('.navegacion');
    let main = document.querySelector('.main');

    toggle.onclick = function(){
        navegacion.classList.toggle('active');
        main.classList.toggle('active');
    }

    let list = document.querySelectorAll('.navegacion li');
    function activeLink(){
        list.forEach((item)=>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item)=>
    item.addEventListener('mouseover', activeLink))
</script>
<script>
    document.getElementById("departamento").addEventListener("change", function() {
    var departamento = this.value;
    var ciudades = <?php echo json_encode($departamentos); ?>;
    var ciudadDropdown = document.getElementById("ciudad");

    ciudadDropdown.innerHTML = '<option value="" selected>Selecciona un departamento primero</option>';
    ciudadDropdown.disabled = true;


    if (departamento in ciudades) {
        ciudades[departamento].forEach(function(ciudad) {
            var option = document.createElement("option");
            option.value = ciudad;
            option.text = ciudad;
            ciudadDropdown.add(option);
        });


        ciudadDropdown.disabled = false;
    }
});
</script>
<script>
    setTimeout(()=>{
        window.history.replaceState(null,null,window.location.pathname);
    },0)
</script>
<script src="http://localhost/Proyecto/cliente/assets/js/scriptform.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/js/script2.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/js/sweet.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/js/script.js"></script>
<script src="http://localhost/Proyecto/cliente/assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</body>
</html>
