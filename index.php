<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Índice</title>
    </head>
    <body>
        <h1> Stucom - Índice</h1>
        <a href="listadoprofesores.php">Listado de Profesores y sus módulos</a><br>
        <?php
        session_start();
        if (isset($_SESSION['login'])){ //si está logueado, mostramos el menú completo
        ?>
            <a href="altaprofesor.php">Alta Profesor</a><br>
            <a href="editarprofesor.php">Editar Profesor</a><br>
            <a href="altamodulo.php">Alta, baja y lista de módulos de profesor</a><br>
            <a href="logout.php">Logout</a>
        <?php
        } else { //si no, mostramos simplemente el siguiente
        ?>
            <a href="loginsys.php">¿Eres un gestor académico? Haz click aquí</a><br/>
        <?php
        }
        ?>
    </body>
</html>