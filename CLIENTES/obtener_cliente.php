<?php
// obtener_cliente.php

// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establecer el encabezado de contenido a JSON
header('Content-Type: application/json');

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['correo_elec'])) {
        $correo_elec = $_POST['correo_elec'];

        // Configuración de la base de datos
        $dbConfig = array(
            'servername' => 'localhost',
            'username' => 'radiador_operador',
            'password' => '!9u?HW+^5N}4',
            'dbname' => 'radiador_taller'
        );

        // Conectar a la base de datos
        $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

        // Verificar conexión
        if ($conn->connect_error) {
            echo json_encode(['error' => "Connection failed: " . $conn->connect_error]);
            exit();
        }

        // Preparar la consulta SQL
        $sql = "SELECT id_Pers, nom_Pers, apell_Pers, correo_elec FROM Persona WHERE correo_elec = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo json_encode(['error' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
            exit();
        }
        
        // Vincular parámetros y ejecutar
        $stmt->bind_param("s", $correo_elec);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el registro
        if ($result->num_rows > 0) {
            $datos = $result->fetch_assoc();
            echo json_encode($datos);
        } else {
            echo json_encode(['error' => "No records found"]);
        }

        // Cerrar conexión y declaración
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['error' => "No email provided"]);
    }
} else {
    echo json_encode(['error' => "Invalid request method"]);
}
?>

