<?php include("../layout/plantilla.php");
session_start();
?>
<body class="bg-gray-100 flex items-center justify-center ">
    
    <div class="w-full max-w-md">
        <div><h2 class="text-center font-mono text-2xl font-bold mb-6">Gesti&oacuten de Clientes</h2></div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            
            <div class="flex flex-col space-y-4">
                <a href="./registro.php" class="bg-gray-300 hover:bg-grey-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                    Crear Cliente
                </a>
                <a href="./modificar_cliente.php" class="bg-gray-300 hover:bg-grey-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                    Modificar Cliente
                </a>
                <a href="./eliminar_cliente.php" class="bg-gray-300 hover:bg-grey-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center">
                    Eliminar Cliente
                </a>
            </div>
        </div>
    </div>
</body>
