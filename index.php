<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Índice</title>
    </head>
    <body>
        <h1> Stucom - Índice</h1>
        <a href="listadoprofesores.php">Listado Profesores</a><br>
        <?php
        session_start();
        if (isset($_SESSION['login'])){
        ?>
            <a href="altaprofesor.php">Alta Profesor</a><br>
            <a href="editarprofesor.php">Editar Profesor</a><br>
            <a href="altamodulo.php">Alta, baja y lista de módulos de profesor</a><br>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['login'])){
            ?>
            <a href="logout.php">Logout</a>
            <?php
        } else {
        ?>
            <a href="loginsys.php">¿Eres un gestor académico? Haz click aquí</a><br/>
        <?php
        }
        ?>
    </body>
</html>