<?php
$servername = "localhost";
$dbname = "radiador_taller";
$username = "radiador_operador";
$password = "!9u?HW+^5N}4";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {
    echo "Intentando conectar a la base de datos...<br>";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa.<br>";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage() . "<br>";
    echo "Código de error: " . $e->getCode() . "<br>";
    echo "Archivo: " . $e->getFile() . "<br>";
    echo "Línea: " . $e->getLine() . "<br>";
}
?>
