<?php include("./layout/plantilla.php");?>

<body class="bg-gray-100 flex items-center justify-center  pt-5">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="h3 font-mono text-center">Registro Usuario Sistema</h1>
        <form  action="insercion.php" method="post"> 
            <div class="mb-1">
                <label for="nom_Pers" class="block text-gray-700">Nombre</label>
                <input type="text" id="nom_Pers" name="nom_Pers" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="apell_Pers" class="block text-gray-700">Apellido</label>
                <input type="text" id="apell_Pers" name="apell_Pers" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="correo_elec" class="block text-gray-700">Correo Electronico</label>
                <input type="email" id="correo_elec" name="correo_elec" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="pass" class="block text-gray-700">Contrasena</label>
                <input type="password" id="pass" name="pass" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="id_Tipo_Pers" class="block text-gray-700">Tipo de Persona</label>
                <select id="id_Tipo_Pers" name="id_Tipo_Pers" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Seleccione Tipo de persona</option>
                    <option value="1">natural</option>
                    <option value="2">juridica</option>
                    <option value="3">otro</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="id_Perm" class="block text-gray-700">Nombre del Permiso</label>
                  <select id="id_Perm" name="id_Perm" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Seleccione un permiso</option>
                    <option value="1">administrador</option>
                    <option value="2">cliente</option>
                    <option value="3">supervisor</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>
