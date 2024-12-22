<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$dbname = "radiador_taller";
$username = "radiador_operador";
$password = "!9u?HW+^5N}4";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que se reciban los datos necesarios
    if (isset($_POST['id_Eval']) && isset($_POST['Est_Eval'])) {
        $id_Eval = $_POST['id_Eval'];
        $Est_Eval = $_POST['Est_Eval'];

        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta UPDATE
            $sql = "UPDATE Evaluacion 
                    SET Est_Eval = :Est_Eval, fecha_creacion = NOW() 
                    WHERE id_Eval = :id_Eval";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Est_Eval', $Est_Eval, PDO::PARAM_STR);
            $stmt->bindParam(':id_Eval', $id_Eval, PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir a la URL especificada
                header("Location: https://radiadoresalbuerno.cl/sistemaAlbuerno/index2.php");
                exit; // Asegurarse de detener la ejecución después de la redirección
            } else {
                echo "Error al actualizar los datos.";
            }
        } catch (PDOException $e) {
            echo "Error en la conexión o consulta: " . $e->getMessage();
        }
    } else {
        echo "Datos incompletos: falta 'id_Eval' o 'Est_Eval'.";
    }
} else {
    echo "Método no permitido.";
}
?>

