<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Ordenes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"></script>
 <?php
session_start();

//Verificar si la sesion esta activa
if (!isset($_SESSION['correo_elec'])) {
    header("Location: login.html");
    exit();
}
?>
</head>
<body>
    <?php include("./layout/plantilla.php");?>
    
<div class="container">
<?php  include("./layout/nav1.php");?>
</div>

    <div class="container">
    <h1>Dashboard de Ordenes</h1>

<?php
// Establecer la conexión a la base de datos

try {
    $servername = "localhost";
    $dbname = "radiador_taller";
    $username = "radiador_operador";
    $password = "!9u?HW+^5N}4";
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Crear archivo CSV
    $filename = "reporte_estados_" . date('Y-m-d') . ".csv";
    $filepath = "descargas/" . $filename;
    
    // Asegúrate de que el directorio existe
    if (!file_exists('descargas')) {
        mkdir('descargas', 0777, true);
    }
    
    // Abrir archivo para escribir
    $file = fopen($filepath, 'w');
    
    // Escribir encabezados
    fputcsv($file, array('Estado de Evaluación', 'Total'));
    
    // Consulta y escritura de datos
    $query = "SELECT Est_Eval, COUNT(*) AS total FROM Evaluacion GROUP BY Est_Eval";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($file, $row);
    }
    
    fclose($file);
    
    // Agregar estilos CSS
    echo "<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .download-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>";
    
    // Botón de descarga
    echo "<a href='" . $filepath . "' download class='download-btn'>Descargar Reporte CSV</a>";
    
    // Mostrar tabla HTML
    echo "<table>
    <tr>
        <th>Estado de Evaluación</th>
        <th>Total</th>
    </tr>";
    
    // Reiniciar el statement para la tabla HTML
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Est_Eval']) . "</td>";
        echo "<td>" . htmlspecialchars($row['total']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>


<?php
try {
    $servername = "localhost";
    $dbname = "radiador_taller";
    $username = "radiador_operador";
    $password = "!9u?HW+^5N}4";

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Agregar estilo CSS para la tabla
    echo "<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>";

    // Consulta para obtener las fechas y calcular la diferencia
    $query = "SELECT
        id_Eval,
        fecha_creacion,
        fecha_cierre,
        TIMESTAMPDIFF(HOUR, fecha_creacion, fecha_cierre) as horas_diferencia,
        TIMESTAMPDIFF(DAY, fecha_creacion, fecha_cierre) as dias_diferencia
        FROM Evaluacion
        WHERE fecha_cierre IS NOT NULL";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    echo "<table>
    <tr>
        <th>ID Orden</th>
        <th>Fecha Creación</th>
        <th>Fecha Cierre</th>
        <th>Diferencia (Horas)</th>
        <th>Diferencia (Días)</th>
    </tr>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_Eval']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha_creacion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha_cierre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['horas_diferencia']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dias_diferencia']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // descargar
    // Crear archivo CSV
    $filename = "reporte_tiempos_" . date('Y-m-d') . ".csv";
    $filepath = "descargas/" . $filename;
    
    // Asegúrate de que el directorio existe
    if (!file_exists('descargas')) {
        mkdir('descargas', 0777, true);
    }
    
    // Abrir archivo para escribir
    $file = fopen($filepath, 'w');
    
    // Escribir encabezados
    fputcsv($file, array('ID Orden', 'Fecha Creación', 'Fecha Cierre', 'Horas', 'Días'));
    
    // Consulta y escritura de datos
    $query = "SELECT 
        id_Eval,
        fecha_creacion,
        fecha_cierre,
        TIMESTAMPDIFF(HOUR, fecha_creacion, fecha_cierre) as horas_diferencia,
        TIMESTAMPDIFF(DAY, fecha_creacion, fecha_cierre) as dias_diferencia
        FROM Evaluacion
        WHERE fecha_cierre IS NOT NULL";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($file, $row);
    }
    
    fclose($file);
    
    // Botón de descarga
    echo "<a href='" . $filepath . "' download class='download-btn'>Descargar Reporte CSV</a>";
    

} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
</div>
</body>
</html>

