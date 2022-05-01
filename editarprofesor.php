<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Editar profesor</title>
    </head>
    <body>
        <?php
        require_once 'functions.php'; //pedimos archivo de funciones
        $resultado = mostrarTodosProfesores(); //y mostramos los profes
        $existe = verPagina();
        if ($existe == 1 && isLogged()) { //comprobamos si puede ver la página
            if (isset($_GET["profesor"]) && $_GET["profesor"] != existeProfesor($_GET["profesor"])) {
                echo "ERROR: A no ser que seas el mismísimo Dios en persona, nadie puede editar un profesor que no existe.<br/>";
            } else {
                ?>
                <h1>Stucom - Editar profesor</h1>
                    <?php
                    if (isset($_GET['boton'])) { //cuando enviemos el form
                        if ($resultado = 'ok') { //si ha funcionado
                            $profesor = $_GET['profesor'];
                            $fila2 = mysqli_fetch_assoc(selectAllProfeAttributes($profesor));
                            ?>
                            <h3>DNI del profesor seleccionado: <?php echo $profesor; ?></h3>
                            <form method="POST">
                                Nombre: <input type="text" name="nombre" value="<?php echo $fila2["nombre"] ?>" required><br/>
                                Apellidos: <input type="text" name="apellidos" value="<?php echo $fila2["apellidos"] ?>" required><br/>
                                Edad: <input type="number" name="edad" min=18 max=65 value="<?php echo $fila2["edad"] ?>" required><br/>
                                Ciclos: <input type="text" name="ciclos" value="<?php echo $fila2["ciclos"] ?>" required><br/>
                                Colegio: <input type="text" name="colegio" value="<?php echo $fila2["colegio"] ?>"><br/>
                                <input type="submit" name="boton2" value="Enviar">
                            </form>
                            <?php
                        } else {//si no,
                            echo $resultado; //mostramos error
                        }
                    } else {
                        ?>
                        <form method="GET">
                        Selecciona un profesor: <select name="profesor" required>
                        <?php
                        while ($fila = mysqli_fetch_assoc($resultado)) { //y con el while mostramos todos los profes en el desplegable
                            echo "<option value='" . $fila["dni"] . "'>";
                            echo $fila["nombre"], " ", $fila["apellidos"];
                            echo "</option>";
                        }
                        ?>      
                        </select>
                        <input type="submit" name="boton" value="Enviar">
                        </form>
                        <?php
                    }
                    if (isset($_POST['boton2'])) {
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $edad = $_POST['edad'];
                        $ciclos = $_POST['ciclos'];
                        $colegio = $_POST['colegio'];
                        empty($colegio) ? $colegio = 'Stucom' : $colegio = $colegio;
                        $resultado2 = actualizarProfesor($nombre, $apellidos, $edad, $profesor, $ciclos, $colegio); //lo actualizamos
                        if ($resultado2 == "ok") { //si el update es correcto
                            echo "<br>Profesor actualizado<br>";//mostramos mensaje
                            echo "Volviendo al menú...<br>"; 
                            header("Refresh:2; url=index.php"); //y redirigimos al menú
                        } else { //si no, mostramos error
                            echo "Error: $resultado<br>";
                        }
                    }
                }
            } else { //si no puede ver la página
                echo "Debes inciar sesión cómo gestor académico o registrar al menos un profesor para acceder a esta página.<br>"; //mostramos error
            }
            ?>
            <a href="index.php">Volver al menú</a>
    </body>
</html>
