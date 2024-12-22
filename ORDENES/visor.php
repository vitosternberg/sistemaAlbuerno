<?php
session_start();
//Verificar si la sesion esta activa
if (!isset($_SESSION['correo_elec'])) {
    header("Location: login.html");
    exit();
}
?>
<body class="bg-gray-100">
<div class="container">
    <h2 class="text-2xl font-semibold mb-4">Visor de Evaluaciones</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-1 py-2 border-b border-gray-200">ID Evaluación</th>
                    <th class="px-1 py-2 border-b border-gray-200">Nombre Persona</th>
                    <th class="px-1 py-2 border-b border-gray-200">Nombre Empresa</th>
                    <th class="px-1 py-2 border-b border-gray-200">Estado Artículo</th>
                    <th class="px-1 py-2 border-b border-gray-200">Estado Evaluación</th>
                    <th class="px-1 py-2 border-b border-gray-200">Nombre Artículo</th>
                    <th class="px-1 py-2 border-b border-gray-200">Clasificación</th>
                    <th class="px-1 py-2 border-b border-gray-200">Detalle</th>
                    <th class="px-1 py-2 border-b border-gray-200">Orden de Compra</th>
                    <th class="px-1 py-2 border-b border-gray-200">Nota de venta Interna</th>
                    <th class="px-1 py-2 border-b border-gray-200">Fecha de Cierre</th>
                </tr>
            </thead>
<tbody>
    <?php
    $servername = "localhost";
    $dbname = "radiador_taller";
    $username = "radiador_operador";
    $password = "!9u?HW+^5N}4";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT * FROM Evaluacion WHERE fecha_cierre IS NULL");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Comparar fechas para determinar si han pasado más de 2 días desde la creación
            $fecha_creacion = new DateTime($row['fecha_creacion']);
            $hoy = new DateTime();
            $diferencia = $hoy->diff($fecha_creacion)->days;

            // Agregar clase CSS si han pasado más de 2 días
            $claseFila = ($diferencia > 2) ? "text-red-500" : "";

            echo "<tr class='$claseFila'>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['id_Eval']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['nom_Pers']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['nom_Emp']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Est_Arti']) . "</td>";

            // Campo Est_Eval como select
            echo "<td class='px-1 py-2 border-b border-gray-200'>
                    <form action='procesa_Evaluacion_Est.php' method='post'>
                        <input type='hidden' name='id_Eval' value='" . htmlspecialchars($row['id_Eval']) . "'>
                        <select name='Est_Eval' class='border rounded px-2 py-1'>
                            <option value='Iniciada'" . ($row['Est_Eval'] == 'Iniciada' ? ' selected' : '') . ">Iniciada</option>
                            <option value='En Proceso'" . ($row['Est_Eval'] == 'En Proceso' ? ' selected' : '') . ">En Proceso</option>
                            <option value='Completada'" . ($row['Est_Eval'] == 'Completada' ? ' selected' : '') . ">Completada</option>
                            <option value='Rechazada'" . ($row['Est_Eval'] == 'Rechazada' ? ' selected' : '') . ">Rechazada</option>
                        </select>
                        <button type='submit' class='ml-2 bg-blue-500 text-white px-3 py-1 rounded'>Guardar</button>
                    </form>
                  </td>";

            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['nom_Arti']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Clasi']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Deta']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Coti']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['OrTr']) . "</td>";
            echo "<td class='px-1 py-2 border-b border-gray-200'>
                    <form action='procesa_Evaluacion_Fecha.php' method='post'>
                        <input type='hidden' name='id_Eval' value='" . htmlspecialchars($row['id_Eval']) . "'>
                        <input type='date' name='fecha_cierre' class='border rounded px-2 py-1'>
                        <button type='submit' class='ml-2 bg-blue-500 text-white px-3 py-1 rounded'>Guardar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='11' class='px-1 py-2 border-b border-gray-200 text-red-500'>Error de conexión: " . $e->getMessage() . "</td></tr>";
    }
    ?>
</tbody>

        </table>
    </div>
</div>
</body>


