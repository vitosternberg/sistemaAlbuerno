<?php
//session_start();
$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);
// Crear la conexion utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);
$sql = "SELECT id_Pers, nom_Pers, apell_Pers FROM Persona";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100  flex flex-col">
      <?php include ("../layout/cabecera.php");?>
<div class="container mx-auto px-4 mt-16">
    <nav class="flex bg-white p-3 rounded-md shadow-md" aria-label="Breadcrumb">
        <ol class="inline-flex space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="index.php" class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                  Inicio
                </a>
            </li>
            <li>
                <div class="flex items-center">
                   <a href="eliminar_cliente.php" class="text-gray-700 hover:text-gray-900">> Eliminaci&oacuten</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <span class="text-gray-500">> Eliminaci&oacuten de Usuario</span>
                </div>
            </li>
        </ol>
    </nav>
</div>
  

    <!-- Form Container -->
    <div class="flex-grow flex items-center  mt-2">
        <div class="container mx-auto px-4">
            <div class="bg-white shadow-md rounded px-2 pt-2 pb-2 mb-4">
                <form action="procesar_formulario.php" method="post">
                    <input type="hidden" name="accion" value="eliminar">
                    <div class="mb-4">
                        <label for="id_Pers" class="block text-gray-700 text-sm font-bold mb-2">Selecciona el cliente a eliminar:</label>
                        <select id="id_Pers" name="id_Pers" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <option value="<?php echo $row['id_Pers']; ?>">
                                    <?php echo $row['nom_Pers'] . " " . $row['apell_Pers']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Eliminar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
