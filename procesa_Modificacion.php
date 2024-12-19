<?php
session_start();
//require 'conexion.php';
$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);
// Crear la conexion utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);


// Verificar si hay una sesi¨®n activa
if (!isset($_SESSION['loggedin'])) {
    header('Location: index2.php');
    exit;
}

// Obtener el ID del cliente a modificar (puedes obtener esto de una URL o de una sesi¨®n)
$cliente_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($cliente_id) {
    // Obtener los datos actuales del cliente
    $sql = "SELECT * FROM Persona WHERE id_Pers = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();
} else {
    echo "Error: ID de cliente no proporcionado.";
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-center text-2xl font-bold mb-6">Modificar Cliente</h2>
            <?php if ($cliente): ?>
                <form action="procesar_modificacion_cliente.php" method="post">
                    <input type="hidden" name="id_Pers" value="<?php echo $cliente['id_Pers']; ?>">
                    <div class="mb-4">
                        <label for="nom_Pers" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" id="nom_Pers" name="nom_Pers" value="<?php echo $cliente['nom_Pers']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="apell_Pers" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                        <input type="text" id="apell_Pers" name="apell_Pers" value="<?php echo $cliente['apell_Pers']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="correo_elec" class="block text-gray-700 text-sm font-bold mb-2">Correo Electr¨®nico:</label>
                        <input type="email" id="correo_elec" name="correo_elec" value="<?php echo $cliente['correo_elec']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            <?php// else: ?>
                <p class="text-red-500 text-center">Cliente no encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
