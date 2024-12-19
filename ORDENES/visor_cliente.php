
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
    
    // Obtener el correo del usuario de la sesión
    $correo_usuario = $_SESSION['correo_elec'];
    // Después de obtener $correo_usuario
var_dump("Correo en sesión:", $_SESSION['correo_elec']);
    
    // Consulta con JOIN entre Persona y Evaluación
    $sql = "SELECT e.*
            FROM Evaluacion e
            INNER JOIN Empresa emp ON e.id_Emp = emp.id_Emp
            INNER JOIN Persona p ON emp.id_Emp = p.id_Emp
            WHERE p.correo_elec = ?
            AND e.fecha_cierre IS NULL";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$correo_usuario]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $fecha_creacion = new DateTime($row['fecha_creacion']);
        $hoy = new DateTime();
        $diferencia = $hoy->diff($fecha_creacion)->days;
        
        $claseFila = ($diferencia > 2) ? "text-red-500" : "";
        
        echo "<tr class='$claseFila hover:bg-gray-50 transition-colors duration-200'>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['id_Eval']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['nom_Pers']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['nom_Emp']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Est_Arti']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Est_Eval']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['nom_Arti']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Clasi']) . "</td>";
        echo "<td class='px-1 py-2 border-b border-gray-200'>" . htmlspecialchars($row['Deta']) . "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='8' class='px-1 py-2 border-b border-gray-200 text-red-500'>Error de conexión: " . $e->getMessage() . "</td></tr>";
}
?>
            </tbody>
        </table>
    </div>
</div>
</body>