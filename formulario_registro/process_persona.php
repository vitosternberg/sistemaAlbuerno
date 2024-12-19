<?php
session_start();
$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);

// Crear la conexion utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_Pers = $_POST['nom_Pers'];
    $apell_Pers = $_POST['apell_Pers'];
    $correo_elec = $_POST['correo_elec'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $id_Tipo_Pers = $_POST['id_Tipo_Pers'];
    $id_Perm = $_POST['id_Perm'];

    // Validar que la combinación de nombre y apellido o el correo electrónico no exista
    $sql = "SELECT COUNT(*) AS count FROM Persona WHERE (nom_Pers = ? AND apell_Pers = ?) OR correo_elec = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nom_Pers, $apell_Pers, $correo_elec);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Error: La combinación de nombre y apellido o el correo electrónico ya existe.";
    } else {
        // Almacenar los datos en sesiones
        $_SESSION['nom_Pers'] = $nom_Pers;
        $_SESSION['apell_Pers'] = $apell_Pers;
        $_SESSION['correo_elec'] = $correo_elec;
        $_SESSION['pass'] = $pass;
        $_SESSION['id_Tipo_Pers'] = $id_Tipo_Pers;
        $_SESSION['id_Perm'] = $id_Perm;

        header("Location: empresa_form.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

