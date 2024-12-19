<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gesti&oacuten de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center h-screen">
   <?php include ("../layout/cabecera.php");?>
   <div class="container">
<?php  include("../layout/nav1.php");?>
</div>

<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    <div class="flex-grow flex  justify-center mt-20 w-full">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-center text-2xl font-bold mb-6">Gesti&oacuten de Clientes</h2>
                <div class="flex flex-col space-y-4">
                    <a href="crear_cliente.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                        Crear Cliente
                    </a>
                    <a href="modificar_cliente.php" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                        Modificar Cliente
                    </a>
                    <a href="eliminar_cliente.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                        Eliminar Cliente
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
