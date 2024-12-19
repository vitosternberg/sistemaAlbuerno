<?php
require 'conexion.php';

/* Datos a insertar
$nom_Pers = "German";
$apell_Pers = "Reyes";
$correo_elec = "primagen1@gmail.com";
$pass = "Vito.1234";
$id_Tipo_Pers = "1";  // Asegúrate de que este valor coincide con el esperado en la base de datos
$id_Perm = "1"; // Asegúrate de que este valor coincide con el esperado en la base de datos*/


$nom_Pers = $_POST['nom_Pers'];
$apell_Pers = $_POST['apell_Pers'];
$correo_elec = $_POST['correo_elec'];
$pass = $_POST['pass'];
$id_Tipo_Pers = $_POST['id_Tipo_Pers'];  // Asegúrate de que este valor coincide con el esperado en la base de datos
$id_Perm = $_POST['id_Perm']; // Asegúrate de que este valor coincide con el esperado en la base de datos


// Hash de la contraseña
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

try {
     // Consulta para verificar si la combinación de nombre y apellido o el correo electrónico ya existen
    $sql_check = "SELECT COUNT(*) FROM Persona WHERE (nom_Pers = '$nom_Pers' AND apell_Pers = '$apell_Pers') OR correo_elec = '$correo_elec'";
    $stmt_check = $conn->prepare($sql_check);

    // Vincular los parámetros
    $stmt_check->bindParam('nom_Pers', $nom_Pers);
    $stmt_check->bindParam('apell_Pers', $apell_Pers);
    $stmt_check->bindParam('correo_elec', $correo_elec);

    // Ejecutar la consulta
    $stmt_check->execute();

    // Obtener el resultado
    $exists = $stmt_check->fetchColumn();

    if ($exists > 0) {
        echo "Advertencia: Ya existe un registro con esta combinación de nombre y apellido o este correo electronico.";
    } else {
        // Consulta SQL para insertar datos usando declaración preparada
        $sql = "INSERT INTO `Persona` (`id_Pers`,`nom_Pers`,`apell_Pers`,`correo_elec`,`pass`,`id_Tipo_Pers`,`id_Perm`) 
                VALUES (NULL,'$nom_Pers','$apell_Pers','$correo_elec','$hashed_password','$id_Perm','$id_Perm')";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam('nom_Pers', $nom_Pers);
        $stmt->bindParam('apell_Pers', $apell_Pers);
        $stmt->bindParam('correo_elec', $correo_elec);
        $stmt->bindParam('pass', $hashed_password);
        $stmt->bindParam('id_Tipo_Pers', $id_Tipo_Pers);
        $stmt->bindParam('id_Perm', $id_Perm);

        // Ejecutar la consulta
        $stmt->execute();

        echo "Nuevo registro creado exitosamente";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; // Cerrar la conexión
?>
