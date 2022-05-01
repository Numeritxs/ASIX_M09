<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Módulos de profesor</title>
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
                <h1>Stucom - Módulos de profesor</h1>
                    <?php
                    if (isset($_GET['boton'])) { //cuando enviemos el form
                        if ($resultado = 'ok') { //si ha funcionado
                            $profesor = $_GET['profesor'];
                            $resultado2 = mostrarTodosModulos($profesor); //mostramos los modulos del profesor seleccionado
                            $resultado3 = mostrarTodosModulos($profesor, true); //mostramos los demás módulos

                            ?>
                            <h3>DNI del profesor seleccionado: <?php echo $profesor; ?></h3>
                            <form method="POST">
                            Selecciona los módulos:<br/>
                                <?php
                                while ($fila2 = mysqli_fetch_assoc($resultado2)) { //y con el while mostramos todos los modulos en el desplegable
                                    echo "<input type='checkbox' name='modulos[]' value='" . $fila2["nombre"] . "'checked />";
                                    echo $fila2["nombre"]; ?><br/><?php
                                }
                                while ($fila3 = mysqli_fetch_assoc($resultado3)) { //y con el while mostramos todos los modulos en el desplegable
                                    echo "<input type='checkbox' name='modulos[]' value='" . $fila3["nombre"] . "'/>";
                                    echo $fila3["nombre"]; ?><br/><?php
                                }
                                ?>
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
                        $resultado4 = insertOrDeleteModuloProfesor($_POST['modulos'], $profesor);
                        header("Refresh:0; url=altamodulo.php?profesor=$profesor&boton=Enviar");
                    }
                }
            } else { //si no puede ver la página
                echo "Debes inciar sesión cómo gestor académico o registrar al menos un profesor para acceder a esta página.<br>"; //mostramos error
            }
            ?>
            <a href="index.php">Volver al menú</a>
    </body>
</html>
