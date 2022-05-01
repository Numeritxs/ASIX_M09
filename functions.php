<?php
//funcion de conexion con la bbdd
function conectar() {
    $conexion = mysqli_connect("localhost", "root", "", "stucomivan"); //nos conectamos a la bbdd
    if (!$conexion) { //si da error
        die("Error en la conexión"); //mostramos mensaje
    }
    return $conexion;
}

//funcion de desconexión con la bbdd
function desconectar($conexion) {
    mysqli_close($conexion); //cerramos conexión
}

//funcion para insertar profesor en la bbdd
function insertarProfesor($nombre, $apellidos, $edad, $dni, $ciclos, $colegio = 'Stucom') {
    $date = date('Y/m/d');
    $c = conectar();
    $insert = "insert into profesores values ('$nombre', '$apellidos', '$edad', '$dni', '$ciclos', '$colegio', '$date')";
    if (mysqli_query($c, $insert) === false) {
        $resultado = mysqli_error($c);
    } else {
        $resultado = "ok";
    }
    $d = desconectar($c);
    return $resultado;
}

//funcion para comprobar si existe un profesor con un dni especifico
function existeProfesor($dni) {
    $c = conectar();
    $select = "select * from profesores where dni = '$dni'";
    $resultado = mysqli_query($c, $select);
    //comrpobamos que el resultado dé una fila
    if (mysqli_num_rows($resultado) == 1) {
        $existe = true;
    } else {
        $existe = false;
    }
    $d = desconectar($c);
    return $existe;
}

//funcion para mostrar todos los profesores
function mostrarTodosProfesores() {
    $c = conectar();
    $select = "select * from profesores";
    $resultado = mysqli_query($c, $select);
    $d = desconectar($c);
    return $resultado;
}

//funcion para añadir modulo a profesor
function insertOrDeleteModuloProfesor($modulos, $profe) {
    $c = conectar();
    foreach ($modulos as $modulo) {
        $select = "select * from modulos_profes where dni = '$profe' and nombre = '$modulo'";
        $demas = mostrarTodosModulos();
        while ($fila3 = mysqli_fetch_assoc($demas)) { //y con el while mostramos todos los modulos en el desplegable
            $moduloborrar = $fila3["nombre"];
            if (!in_array($moduloborrar, $modulos)) {
                $delete = "delete from modulos_profes where dni = '$profe' and nombre = '$moduloborrar'";
                if (mysqli_query($c, $delete) === false) {
                    $resultado = mysqli_error($c);
                } else {
                    $resultado = "ok";
                }
            }
        }
        $resultadoo = mysqli_query($c, $select);
        if (mysqli_num_rows($resultadoo) == 0) {
            $insert = "insert into modulos_profes values ('$profe', '$modulo')";
            if (mysqli_query($c, $insert) === false) {
                $resultado = mysqli_error($c);
            } else {
                $resultado = "ok";
            }
        } else {
            $resultado = "Ya existe.";
        }
    }
    $d = desconectar($c);
    return $resultado;
}

//funcion para mostrar todos los modulos
function mostrarTodosModulos($profe = "ninguno", $exceptProfeOnes = false) {
    $c = conectar();
    if ($profe == "ninguno") {
        $select = "select * from modulos";
        $resultado = mysqli_query($c, $select);
    } else if ($exceptProfeOnes) {
        $select = "SELECT * FROM `modulos` WHERE nombre not in (select nombre from modulos_profes where dni = '$profe')";
        $resultado = mysqli_query($c, $select);
    } else {
        $select = "select * from modulos inner join modulos_profes on modulos.nombre = modulos_profes.nombre where modulos_profes.dni = '$profe'";
        $resultado = mysqli_query($c, $select);
    }
    $d = desconectar($c);
    return $resultado;
}

//funcion para comprobar si puedo ver las paginas
function verPagina() {
    $c = conectar();
    $select = "select * from profesores";
    $resultado = mysqli_query($c, $select);
    if (mysqli_num_rows($resultado) > 0) {
        return true;
    } else {
        return false;
    }
    $d = desconectar($c);
}

//funcion para seleccionar todos los profesores ordenados
function selectAllProfesoresOrdenaditos() {
    $c = conectar();
    $select = "select * from profesores order by nombre desc";
    $resultado = mysqli_query($c, $select);
    return $resultado;
}

//funcion para loguear como gestor academico
function login($usuario, $contrasenya) {
    $c = conectar();
    $select = "select * from gestores where user = '$usuario'";
    $resultado = mysqli_query($c, $select);
    //comrpobamos que el resultado dé una fila y que la pass sea correcta
    if (mysqli_num_rows($resultado) == 1 && mysqli_fetch_assoc(mysqli_query($c, $select))["password"] == password_verify($contrasenya, mysqli_fetch_assoc(mysqli_query($c, $select))["password"])) {        
        $existe = true;
    } else {
        $existe = false;
    }
    $d = desconectar($c);
    return $existe;
}

function isLogged() {
    session_start();
    if (isset($_SESSION['login']) && $_SESSION['login']) {
        return true;
    } else {
        return false;
    }
}

//funcion para seleccionar todos los atributos de un profe
function selectAllProfeAttributes($profe) {
    $c = conectar();
    $select = "select * from profesores where dni = '$profe'";
    $resultado = mysqli_query($c, $select);
    return $resultado;
}

function actualizarProfesor($nombre, $apellidos, $edad, $profesor, $ciclos, $colegio = 'Stucom') {
    $c = conectar();
    $update = "update profesores set nombre='$nombre', apellidos='$apellidos', edad='$edad', ciclos='$ciclos', colegio='$colegio' where dni = '$profesor'";
    if (mysqli_query($c, $update) === false) {
        $resultado = mysqli_error($c);
    } else {
        $resultado = 'ok';
    }
    desconectar($c);
    return $resultado;
}
?>