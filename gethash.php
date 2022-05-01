<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ivan Hash</title>
</head>
<body>
    <h2>Conoce el hash de tu contraseña:</h2>
    <form method=GET>
        Introduce contraseña: <input type="password" name="pass">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
<?php
if (isset($_GET['pass'])) { //cogemos la contraseña del formulario, le pasamos el hash y la imprimimos por pantalla.
    echo "Contraseña cifrada: ";
    echo password_hash($_GET['pass'], PASSWORD_DEFAULT);
}
?>