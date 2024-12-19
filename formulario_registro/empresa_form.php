<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="process_empresa.php" method="post">
                <div class="mb-4">
                    <label for="nom_Emp" class="block text-gray-700 text-sm font-bold mb-2">Nombre Empresa:</label>
                    <input type="text" id="nom_Emp" name="nom_Emp" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="desc_Emp" class="block text-gray-700 text-sm font-bold mb-2">Descripcion Empresa:</label>
                    <input type="text" id="desc_Emp" name="desc_Emp" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
