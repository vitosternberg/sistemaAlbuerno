<?php
// Activar la visualizaci車n de errores para depuraci車n
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Datos de configuraci車n de la base de datos
$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);

// Crear la conexi車n utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

// Verificar la conexi車n
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener permisos desde la base de datos
$sqlPermisos = "SELECT * FROM `Permiso` ORDER BY `nom_Permiso` ASC";
$resultPermisos = $conn->query($sqlPermisos);

// Obtener empresas desde la base de datos
$sqlEmpresas = "SELECT * FROM `Empresa` ORDER BY `nom_Emp` ASC";
$resultEmpresas = $conn->query($sqlEmpresas);

// Verificar si hay resultados
$permisos = [];
if ($resultPermisos) {
    if ($resultPermisos->num_rows > 0) {
        while ($row = $resultPermisos->fetch_assoc()) {
            $permisos[] = $row;
        }
    } else {
        echo "No se encontraron permisos.";
    }
} else {
    echo "Error en la consulta SQL de permisos: " . $conn->error;
}

$empresas = [];
if ($resultEmpresas) {
    if ($resultEmpresas->num_rows > 0) {
        while ($row = $resultEmpresas->fetch_assoc()) {
            $empresas[] = $row;
        }
    } else {
        echo "No se encontraron empresas.";
    }
} else {
    echo "Error en la consulta SQL de empresas: " . $conn->error;
}

// Cerrar la conexi車n
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex flex-col">
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
                   <a href="crear_cliente.php" class="text-gray-700 hover:text-gray-900">> Creaci&oacuten</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <span class="text-gray-500">> Gesti&oacuten de Usuario</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<!-- Welcome Message -->
<div class="flex-grow flex flex-col items-center  mt-20">


    <!-- Form Container -->
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-center text-2xl font-bold mb-6">Crear Cliente</h2>
            <form action="procesar_formulario.php" method="post">
                <input type="hidden" name="accion" value="crear">
                <div class="mb-4">
                    <label for="nom_Pers" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="nom_Pers" name="nom_Pers" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="apell_Pers" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                    <input type="text" id="apell_Pers" name="apell_Pers" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="correo_elec" class="block text-gray-700 text-sm font-bold mb-2">Correo Electr&oacutenico:</label>
                    <input type="email" id="correo_elec" name="correo_elec" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="pass" class="block text-gray-700 text-sm font-bold mb-2">Contrase&ntildea:</label>
                    <input type="password" id="pass" name="pass" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="id_Tipo_Pers" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Persona:</label>
                    <input type="text" id="id_Tipo_Pers" name="id_Tipo_Pers" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="id_Perm" class="block text-gray-700 text-sm font-bold mb-2">Permisos:</label>
                    <select id="id_Perm" name="id_Perm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="">Selecciona un permiso</option>
                        <?php foreach ($permisos as $permiso): ?>
                            <option value="<?php echo $permiso['id_Perm']; ?>"><?php echo $permiso['nom_Permiso']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_Emp" class="block text-gray-700 text-sm font-bold mb-2">Empresa:</label>
                    <select id="id_Emp" name="id_Emp" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="">Selecciona una empresa</option>
                        <?php foreach ($empresas as $empresa): ?>
                            <option value="<?php echo $empresa['id_Emp']; ?>"><?php echo $empresa['nom_Emp']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Crear
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
