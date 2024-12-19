<?php
$servername = "localhost";
$dbname = "radiador_taller";
$username = "radiador_operador";
$password = "!9u?HW+^5N}4";

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si el formulario se envía, procesar los datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_Eval = $_POST['id_Eval']; // ID de la evaluación a actualizar
        $Est_Eval = $_POST['Est_Eval']; // Nuevo estado

        // Consulta de actualización
        $sql = "UPDATE Evaluacion SET Est_Eval = :Est_Eval WHERE id_Eval = :id_Eval";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Est_Eval', $Est_Eval);
        $stmt->bindParam(':id_Eval', $id_Eval);

        if ($stmt->execute()) {
            echo "<p class='text-green-500'>Estado actualizado correctamente.</p>";
        } else {
            echo "<p class='text-red-500'>Error al actualizar el estado.</p>";
        }
    }

    // Obtener los registros de la tabla Evaluacion
    $stmt = $pdo->query("SELECT id_Eval, nom_Pers, Est_Eval FROM Evaluacion");
    $evaluaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estado de Evaluación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Editar Estado de Evaluación</h1>

    <form method="POST" class="bg-white p-4 rounded shadow">
        <label for="id_Eval" class="block text-gray-700 font-medium mb-2">Seleccione la Evaluación:</label>
        <select name="id_Eval" id="id_Eval" class="w-full border-gray-300 rounded px-3 py-2 mb-4" required>
            <option value="" disabled selected>-- Seleccione una evaluación --</option>
            <?php foreach ($evaluaciones as $evaluacion): ?>
                <option value="<?= htmlspecialchars($evaluacion['id_Eval']) ?>">
                    ID: <?= htmlspecialchars($evaluacion['id_Eval']) ?> - <?= htmlspecialchars($evaluacion['nom_Pers']) ?> (Estado: <?= htmlspecialchars($evaluacion['Est_Eval']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="Est_Eval" class="block text-gray-700 font-medium mb-2">Seleccione el nuevo estado:</label>
        <select name="Est_Eval" id="Est_Eval" class="w-full border-gray-300 rounded px-3 py-2 mb-4" required>
            <option value="" disabled selected>-- Seleccione un estado --</option>
            <option value="Iniciada">Iniciada</option>
            <option value="En Proceso">En Proceso</option>
            <option value="Rechazada">Rechazada</option>
            <option value="Completada">Completada</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar Estado</button>
    </form>
</div>

</body>
</html>
