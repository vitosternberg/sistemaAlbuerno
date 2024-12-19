<?php
include("conexion.php");

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*echo "Conexión exitosa<br>"*/;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Ejecutar la consulta
$stmt = $pdo->query("SELECT * FROM display");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Debugging: imprimir los resultados para verificar
/*var_dump($results);*/

?>
<body class="bg-gray-100 p-6">
    <div class="container px-2">
        <h1 class="text-2xl font-bold my-4">Datos flujo trabajo taller</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full ">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-2 py-1">Tipo Persona</th>
                        <th class="px-2 py-1">Persona</th>
                        <th class="px-2 py-1">Direccion</th>
                        <th class="px-2 py-1">Empresa</th>
                        <th class="px-2 py-1">Estado Articulo</th>
                        <th class="px-2 py-1">Articulo</th>
                        <th class="px-2 py-1">Clasificacion</th>
                        <th class="px-2 py-1">Evaluacion</th>
                        <th class="px-2 py-1">Cotizacion</th>
                        <th class="px-2 py-1">Orden Trabajo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Tipo_Persona']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Persona']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Direccion']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Empresa']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Estado_Art']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Articulo']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Clasificacion']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Evaluacion']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Cotizacion']); ?></td>
                                <td class="border px-2 py-1 text-normal"><?php echo htmlspecialchars($row['Orden_Trabajo']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="10">No hay datos disponibles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>


