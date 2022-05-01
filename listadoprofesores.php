<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Listado de Profesores</title>
    </head>
    <body>
        <?php
        require_once 'functions.php'; //pedimos el archivo de funciones
        $existe = verPagina(); 
        if ($existe == 1) { //comprobamos que pueda ver la página
            $profesores = selectAllProfesoresOrdenaditos(); //buscamos todos los profesores en orden
            ?>
            <h2>Stucom - Listado de Profesores </h2>
            <table border="1px">
                <tr>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td>Edad</td>
                    <td>DNI</td>
                    <td>Ciclos</td>
                    <td>Módulos</td>
                    <td>Colegio</td>
                    <td>Fecha de alta</td>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($profesores)) { 
                    $resultado2 = mostrarTodosModulos($fila["dni"]); //buscamos todos los módulos del profesor seleccionado y printamos los datos en la tabla
                    ?>
                    <tr>
                        <td><?php echo $fila["nombre"] ?></td>
                        <td><?php echo $fila["apellidos"] ?></td>
                        <td><?php echo $fila["edad"] ?></td>
                        <td><?php echo $fila["dni"] ?></td>
                        <td><?php echo $fila["ciclos"] ?></td>
                        <td><?php while ($fila2 = mysqli_fetch_assoc($resultado2)) { echo $fila2["nombre"]; ?><br/><?php } //recorremos el array de módulos de el profe seleccionado y los printamos?></td> 
                        <td><?php echo $fila["colegio"] ?></td>
                        <td><?php echo $fila["fecha_alta"] ?></td>
                    </tr>
                    <?php
                }
            } else {//si no puede ver la pagina
                echo "Debes registrar al menos un profesor para acceder a esta página.<br>"; //mostramos error
            }
            ?>
        </table>
        <a href="index.php">Volver al menú</a>
    </body>
</html>
