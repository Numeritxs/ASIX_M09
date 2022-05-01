<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stucom - Login</title>
    </head>
    <body>
        <?php
        require_once 'functions.php'; //pedimos el archivo de las funciones
        ?>
        <h1> Stucom  - Login</h1>
        <form method="POST">
            Usuario: <input type="text" name="user" required><br/>
            Contraseña: <input type="password" name="password" required><br/>
            <input type="submit" name="boton" value="Enviar">
        </form>

        <?php
        
        if (isset($_POST['boton'])) { //si enviamos el formulario
            $usuario = $_POST['user'];
            $contrasenya = $_POST['password'];
            $resultado = login($usuario, $contrasenya); //lo comprobamos
            if ($resultado) { //si el login es correcto
                session_start();
                $_SESSION['login'] = true;
                echo "<br>Login correcto<br>";//mostramos mensaje
                echo "Volviendo al menú...<br>"; 
                header("Refresh:2; url=index.php"); //y redirigimos al menú
            } else { //si no, mostramos error
                echo "Error: Usuario / Contraseña incorrectos.";
            }
        }
        ?>
        <a href="index.php">Volver al menú</a>
    </body>
</html>
