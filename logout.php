<?php
session_start(); //iniciamos la sesión
session_destroy();//la destruimos al instante
header("Refresh:0; url=index.php"); //y redirigimos al menú
?>