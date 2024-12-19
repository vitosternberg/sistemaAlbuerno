<?php
$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);

$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_Pers = $_POST['nom_Pers'];
    $nom_Emp = $_POST['nom_Emp'];
    $id_Emp = $_POST['id_Emp'];  // Agregado
    $esta_Arti = $_POST['esta_Arti'];
    $estado = $_POST['estado'];
    $articulo = $_POST['articulo'];
    $clasificacion = $_POST['clasificacion'];
    $detalle = $_POST['detalle'];
    $coti = $_POST['coti'];
    $ortr = $_POST['ortr'];

    $sql = "INSERT INTO Evaluacion (nom_Pers, nom_Emp, id_Emp, Est_Arti, Est_Eval, nom_Arti, Clasi, Deta, Coti, OrTr)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssssss", $nom_Pers, $nom_Emp, $id_Emp, $esta_Arti, $estado, $articulo, $clasificacion, $detalle, $coti, $ortr);

    if ($stmt->execute()) {
        header("Location: ./index2.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
