<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="process_persona.php" method="post">
                <div class="mb-4">
                    <label for="nom_Pers" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="nom_Pers" name="nom_Pers" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="apell_Pers" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                    <input type="text" id="apell_Pers" name="apell_Pers" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="correo_elec" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico:</label>
                    <input type="email" id="correo_elec" name="correo_elec" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="pass" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                    <input type="password" id="pass" name="pass" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="id_Tipo_Pers" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Persona:</label>
                    <input type="text" id="id_Tipo_Pers" name="id_Tipo_Pers" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="id_Perm" class="block text-gray-700 text-sm font-bold mb-2">Permiso:</label>
                    <input type="text" id="id_Perm" name="id_Perm" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
