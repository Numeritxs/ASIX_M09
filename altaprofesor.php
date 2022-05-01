<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Alta profesor</title>
    </head>
    <body>
        <?php
        require_once 'functions.php'; //pedimos el archivo de las funciones
        if (isLogged()) {//si está logueado, mostramos formulario de alta
            ?>
            <h1> Stucom  - Alta profesor</h1>
            <form method="POST">
                Nombre: <input type="text" name="nombre" required><br/>
                Apellidos: <input type="text" name="apellidos" required><br/>
                Edad: <input type="number" name="edad" min=18 max=65 required><br/>
                Dni: <input type="text" name="dni" minlength=9 maxlength=9 required><br/>
                Ciclos: <input type="text" name="ciclos" required><br/>
                Colegio: <input type="text" name="colegio"><br/>
                <input type="submit" name="boton" value="Enviar">
            </form>

            <?php
            
            if (isset($_POST['boton'])) { //cuando enviamos el formulario, comprobamos algunos campos y registramos al profesor
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $edad = $_POST['edad'];
                $dni = $_POST['dni'];
                $letra = substr($dni, -1);
                $numeros = substr($dni, 0, -1);
                $ciclos = $_POST['ciclos'];
                $colegio = $_POST['colegio'];
                empty($colegio) ? $colegio = 'Stucom' : $colegio = $colegio; //si el campo colegio está vacío, lo rellenamos con Stucom
                $trainer = existeProfesor($dni); //comprobamos si existe el profesor introducido
                if (preg_match("/[a-z]/i", $numeros) || $edad > 65 || $edad < 18 || strlen($dni) != 9) { //comprobamos que los campos sean válidos
                    echo "Has introducido campos erróneos, por favor, inténtalo de nuevo.<br/>Recuerda: el DNI debe tener 9 carácteres y ser válido y la edad debe estar entre 18 y 65 años.<br/>";
                } else {
                    if ($dni == $trainer) { //si existe...
                        echo "Un profesor con este DNI ya existe.<br>";
                    } else if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){ //comprobamos que el DNI sea válido
                        $resultado = insertarProfesor($nombre, $apellidos, $edad, $dni, $ciclos, $colegio); //lo registramos
    
                        if ($resultado == "ok") { //si el registro es correcto
                            echo "<br>Profesor registrado<br>";//mostramos mensaje
                            echo "Volviendo al menú...<br>"; 
                            header("Refresh:2; url=index.php"); //y redirigimos al menú
                        } else { //si no, mostramos error
                            echo "Error: $resultado<br>";
                        }
                    } else { //si no...
                        echo "El DNI introducido no es válido.<br/>";
                    }
                }
            }
        } else { //si no puede ver la página...
            echo "Debes inciar sesión cómo gestor académico para acceder a esta página.<br>"; //mostramos error
        }
            ?>
        <a href="index.php">Volver al menú</a>
    </body>
</html>
