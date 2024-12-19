<?php
$servername = "localhost";
$dbname = "radiador_taller";
$username = "radiador_operador";
$password = "!9u?HW+^5N}4";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['type'])) {
        $type = $_POST['type'];

        if ($type == 'persona') {
            $query = $_POST['query'];
            $stmt = $pdo->prepare("SELECT nom_Pers, apell_Pers FROM Persona WHERE nom_Pers LIKE ? OR apell_Pers LIKE ? LIMIT 10");
            $stmt->execute(["%$query%", "%$query%"]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                echo '<ul class="list-none">';
                foreach ($results as $row) {
                    echo '<li class="px-4 py-2 cursor-pointer hover:bg-gray-200">' . 
                         htmlspecialchars($row['nom_Pers']) . ' ' . 
                         htmlspecialchars($row['apell_Pers']) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<li class="px-4 py-2">No hay resultados</li>';
            }
        } 
        else if ($type == 'empresa') {
            $query = $_POST['query'];
            $stmt = $pdo->prepare("SELECT id_Emp, nom_Emp FROM Empresa WHERE nom_Emp LIKE ? LIMIT 10");
            $stmt->execute(["%$query%"]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                echo '<ul class="list-none">';
                foreach ($results as $row) {
                    echo '<li class="px-4 py-2 cursor-pointer hover:bg-gray-200" data-id="' . 
                         htmlspecialchars($row['id_Emp']) . '">' .
                         htmlspecialchars($row['nom_Emp']) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<li class="px-4 py-2">No hay resultados</li>';
            }
        }
        else if ($type == 'articulo') {
            $stmt = $pdo->query("SELECT nom_Arti FROM Articulo");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                echo '<option value="" disabled selected>Seleccione un artículo</option>';
                foreach ($results as $row) {
                    echo '<option value="' . htmlspecialchars($row['nom_Arti']) . '">' . 
                         htmlspecialchars($row['nom_Arti']) . '</option>';
                }
            } else {
                echo '<option value="" disabled>No hay artículos disponibles</option>';
            }
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
