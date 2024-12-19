<?php
// Configuración de la base de datos
$servername = "localhost";
$dbname = "radiador_taller";
$username = "radiador_operador";
$password = "!9u?HW+^5N}4";

try {
    // Conexión a la base de datos con PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar solo si se recibió una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar y capturar los datos del formulario
        $id_Eval = isset($_POST['id_Eval']) ? intval($_POST['id_Eval']) : null;
        $fecha_cierre = isset($_POST['fecha_cierre']) ? $_POST['fecha_cierre'] : null;

        // Verificar que los valores necesarios no estén vacíos
        if ($id_Eval && $fecha_cierre) {
            // Preparar y ejecutar la consulta para actualizar fecha_cierre
            $sql = "UPDATE Evaluacion SET fecha_cierre = :fecha_cierre WHERE id_Eval = :id_Eval";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':fecha_cierre', $fecha_cierre);
            $stmt->bindParam(':id_Eval', $id_Eval);

            if ($stmt->execute()) {
                // Redirigir o mostrar un mensaje de éxito
                echo "La fecha de cierre se actualizó correctamente.";
                // Redirigir (opcional)
                // header("Location: visor_evaluaciones.php");
                // exit();
            } else {
                echo "Error al actualizar la fecha de cierre.";
            }
        } else {
            echo "Datos incompletos. Por favor, verifica los campos.";
        }
    }
} catch (PDOException $e) {
    // Manejo de errores de conexión
    echo "Error: " . $e->getMessage();
}
?>
