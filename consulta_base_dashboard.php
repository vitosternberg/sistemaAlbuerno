<?php
$servername = "localhost";
$dbname = "radiador_taller";
$username = "radiador_operador";
$password = "!9u?HW+^5N}4";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Contar estados
    $estados = ["Inicio", "Proceso", "Rechazada", "Completada"];
    $dataEstados = [];
    foreach ($estados as $estado) {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM Evaluacion WHERE Est_Eval = :estado");
        $stmt->execute(['estado' => $estado]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $dataEstados[$estado] = $row['total'];
    }

    // Tiempo promedio de cierre
    $stmt = $pdo->query("SELECT DATEDIFF(fecha_cierre, fecha_creacion) AS dias 
                         FROM Evaluacion 
                         WHERE fecha_cierre IS NOT NULL");
    $totalDias = 0;
    $totalOrdenes = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $totalDias += $row['dias'];
        $totalOrdenes++;
    }
    $promedioDias = ($totalOrdenes > 0) ? $totalDias / $totalOrdenes : 0;

    echo json_encode(['estados' => $dataEstados, 'promedioDias' => round($promedioDias, 2)]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
