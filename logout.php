<?php
session_start();

// Destruir todas las variables de sesión.
session_unset();

// Destruir la sesión.
session_destroy();

// Redireccionar a index.html
header("Location: index.html");
exit();
?>
