<?php
session_start();
//require 'conexion.php';

$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);
// Crear la conexion utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_Emp = $_POST['nom_Emp'];
    $desc_Emp = $_POST['desc_Emp'];

    // Validar que el nombre de la empresa no exista
    $sql = "SELECT COUNT(*) AS count FROM Empresa WHERE nom_Emp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nom_Emp);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Error: El nombre de la empresa ya existe.";
    } else {
        // Insertar la nueva empresa
        $sql = "INSERT INTO Empresa (nom_Emp, desc_Emp) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nom_Emp, $desc_Emp);

        if ($stmt->execute()) {
            $id_Emp = $conn->insert_id;

            // Insertar los datos en la tabla Persona
            $sql = "INSERT INTO Persona (nom_Pers, apell_Pers, correo_elec, pass, id_Tipo_Pers, id_Perm, id_Emp) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $_SESSION['nom_Pers'], $_SESSION['apell_Pers'], $_SESSION['correo_elec'], $_SESSION['pass'], $_SESSION['id_Tipo_Pers'], $_SESSION['id_Perm'], $id_Emp);

            if ($stmt->execute()) {
                echo "Persona y Empresa creadas exitosamente.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
