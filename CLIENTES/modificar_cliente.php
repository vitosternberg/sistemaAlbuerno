<?php
function obtenerCorreos() {
    $dbConfig = array(
        'servername' => 'localhost',
        'username' => 'radiador_operador',
        'password' => '!9u?HW+^5N}4',
        'dbname' => 'radiador_taller'
    );
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT correo_elec FROM Persona";
    $result = $conn->query($sql);
    
    $correos = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $correos[] = $row['correo_elec'];
        }
    }
    
    $conn->close();
    return $correos;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function cargarDatosCliente(correo) {
            if (correo === "") {
                document.getElementById("form-modificar").reset();
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "obtener_cliente.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    try {
                        const datos = JSON.parse(this.responseText);
                        if (datos.error) {
                            alert(datos.error);
                            document.getElementById("form-modificar").reset();
                        } else {
                            document.getElementById("id_Pers").value = datos.id_Pers;
                            document.getElementById("nom_Pers").value = datos.nom_Pers;
                            document.getElementById("apell_Pers").value = datos.apell_Pers;
                            document.getElementById("correo_elec").value = datos.correo_elec;
                        }
                    } catch (e) {
                        console.error("Invalid JSON response", e);
                        alert("Hubo un error al procesar la respuesta del servidor.");
                    }
                }
            };
            xhr.send("correo_elec=" + correo);
        }
    </script>
</head>
<body class="bg-gray-100  flex flex-col">
     <div class="text-black text-center font-mono text-lg text-gray-800 pb-5">
        Bienvenido al sistema de gesti&oacuten trabajos Albuerno 1.0
    </div>
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
                   <a href="modificar_cliente.php" class="text-gray-700 hover:text-gray-900">> Modificaci&oacuten</a>
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
   
    <!-- Form Container -->
    <div class="flex-grow flex items-center  mt-2">
        <div class="container mx-auto px-4">
            <h2 class="text-xl font-bold mb-4">Modificar Cliente</h2>
            <form id="form-seleccion" class="mb-6">
                <label for="correo_elec" class="block text-gray-700 font-semibold mb-2">Selecciona un correo:</label>
                <select id="correo_elec" name="correo_elec" onchange="cargarDatosCliente(this.value)" class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Selecciona un correo</option>
                    <?php
                    $correos = obtenerCorreos();
                    foreach ($correos as $correo) {
                        echo "<option value='$correo'>$correo</option>";
                    }
                    ?>
                </select>
            </form>

            <form id="form-modificar" method="POST" action="procesar_formulario.php" class="bg-white p-6 rounded-lg shadow-md">
                <input type="hidden" id="id_Pers" name="id_Pers">
                <div class="mb-4">
                    <label for="nom_Pers" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
                    <input type="text" id="nom_Pers" name="nom_Pers" required class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="apell_Pers" class="block text-gray-700 font-semibold mb-2">Apellido:</label>
                    <input type="text" id="apell_Pers" name="apell_Pers" required class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="correo_elec" class="block text-gray-700 font-semibold mb-2">Correo Electr&oacutenico:</label>
                    <input type="email" id="correo_elec" name="correo_elec" required class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <input type="hidden" name="accion" value="modificar">
                <div class="flex justify-end">
                    <input type="submit" value="Modificar" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
