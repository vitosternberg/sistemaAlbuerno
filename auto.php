<!DOCTYPE html>
<html lang="en">
<head>
 <?php
session_start();
//index3.php
//Verificar si la sesion esta activa
if (!isset($_SESSION['correo_elec'])) {
    header("Location: login.html");
    exit();
}
?>
    
    <meta charset="UTF-8">
    <title>Autocompletar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
       $(document).ready(function() {
    // Código para persona se mantiene igual
    $("#nom_Pers").keyup(function() {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: {query: query, type: 'persona'},
                success: function(data) {
                    $("#suggestion-box-persona").fadeIn();
                    $("#suggestion-box-persona").html(data);
                }
            });
        } else {
            $("#suggestion-box-persona").fadeOut();
            $("#suggestion-box-persona").html("");
        }
    });

    $(document).on("click", "#suggestion-box-persona li", function() {
        $("#nom_Pers").val($(this).text());
        $("#suggestion-box-persona").fadeOut();
    });

    // Código modificado para empresa
    $("#nom_Emp").keyup(function() {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: {query: query, type: 'empresa'},
                success: function(data) {
                    $("#suggestion-box-empresa").fadeIn();
                    $("#suggestion-box-empresa").html(data);
                }
            });
        } else {
            $("#suggestion-box-empresa").fadeOut();
            $("#suggestion-box-empresa").html("");
        }
    });

    // Modificado para capturar tanto el nombre como el ID
    $(document).on("click", "#suggestion-box-empresa li", function() {
        $("#nom_Emp").val($(this).text());
        $("#id_Emp").val($(this).data('id')); // Captura el id_Emp
        $("#suggestion-box-empresa").fadeOut();
    });

    // Cargar artículos en el select
    $.ajax({
        url: "search.php",
        method: "POST",
        data: {type: 'articulo'},
        success: function(data) {
            $("#articulo").html(data);
        }
    });
});
    </script>
    <style>
        #suggestion-box-persona, #suggestion-box-empresa {
            border: 1px solid #ccc;
            display: none;
            position: absolute;
            background-color: white;
            z-index: 1000;
        }
        #suggestion-box-persona li, #suggestion-box-empresa li {
            padding: 10px;
            cursor: pointer;
        }
        #suggestion-box-persona li:hover, #suggestion-box-empresa li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body class="bg-gray-100 p-6 flex flex-col items-center justify-center min-h-screen">
        <?php include ("./layout/cabecera.php");?>
    <div class="container">
<?php  include("./layout/nav1.php");?>
</div>
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="procesa_Evaluacion.php" method="post">
                <div class="mb-4">
                    <label for="nom_Pers" class="block text-gray-700 text-sm font-bold mb-2">Nombre Persona:</label>
                    <input type="text" id="nom_Pers" name="nom_Pers" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div id="suggestion-box-persona" class="absolute bg-white border border-gray-300 w-full mt-1 rounded-lg shadow-lg"></div>
                </div>
              
                <div class="mb-4">
                    <label for="nom_Emp" class="block text-gray-700 text-sm font-bold mb-2">Nombre Empresa:</label>
                    <input type="text" id="nom_Emp" name="nom_Emp" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <div id="suggestion-box-empresa" class="absolute bg-white border border-gray-300 w-full mt-1 rounded-lg shadow-lg" style="display: none;"></div>
                </div>
                
                <div class="mb-4">
                    <label for="id_Emp" class="block text-gray-700 text-sm font-bold mb-2">ID Empresa:</label>
                    <input type="text" id="id_Emp" name="id_Emp" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="esta_Arti" class="block text-gray-700 text-sm font-bold mb-2">Estado Art&iacuteculo:</label>
                    <select id="esta_Arti" name="esta_Arti" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Elija una opci&oacuten</option>
                        <option value="Nuevo">Nuevo</option>
                        <option value="Usado">Usado</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="estado" class="block text-gray-700 text-sm font-bold mb-2">Estado Evaluacion :</label>
                    <select id="estado" name="estado" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Elija una opcion</option>
                        <option value="Iniciada">Iniciada</option>
                        <option value="Completada">Completada</option>
                        <option value="Incompleta">Incompleta</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="articulo" class="block text-gray-700 text-sm font-bold mb-2">Articulo:</label>
                    <select id="articulo" name="articulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Seleccione un articulo</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="clasificacion" class="block text-gray-700 text-sm font-bold mb-2">Clasificaci&oacuten:</label>
                    <select id="clasificacion" name="clasificacion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Seleccione una clasificaci&oacuten</option>
                        <option value="Clasificaci&oacuten 1">Fabricacion</option>
                        <option value="Clasificaci&oacuten 2">Reparacion</option>
                        <option value="Clasificaci&oacuten 2">Garantia</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="detalle" class="block text-gray-700 text-sm font-bold mb-2">Detalle:</label>
                    <textarea id="detalle" name="detalle" maxlength="200" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4"></textarea>
                </div>
                <div class="mb-4">
                    <label for="coti" class="block text-gray-700 text-sm font-bold mb-2">Cotizaci&oacuten:</label>
                    <input type="text" id="coti" name="coti" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="ortr" class="block text-gray-700 text-sm font-bold mb-2">Orden de compra:</label>
                    <input type="text" id="ortr" name="ortr" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>


