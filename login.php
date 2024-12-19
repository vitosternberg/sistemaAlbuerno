<?php
/* Habilitar el reporte de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

/*$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);

// Crear la conexion utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Suponiendo que este es el código para el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_elec = $_POST['correo_elec'];
    $pass = $_POST['pass'];

    // Consulta para obtener la información del usuario con el correo proporcionado
    $sql = "SELECT nom_Pers, apell_Pers, correo_elec, pass, id_Tipo_Pers, id_Perm, id_Emp FROM Persona WHERE correo_elec = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $correo_elec);
    $stmt->execute();
    $stmt->bind_result($nom_Pers, $apell_Pers, $correo_elec, $hashed_pass, $id_Tipo_Pers, $id_Perm, $id_Emp);
    
    if ($stmt->fetch()) {
        // Verificar la contraseña
        if (password_verify($pass, $hashed_pass)) {
            // Iniciar sesión y almacenar los datos del usuario en la sesión
            session_start();
            $_SESSION['nom_Pers'] = $nom_Pers;
            $_SESSION['apell_Pers'] = $apell_Pers;
            $_SESSION['correo_elec'] = $correo_elec;
            $_SESSION['id_Tipo_Pers'] = $id_Tipo_Pers;
            $_SESSION['id_Perm'] = $id_Perm;
            $_SESSION['id_Emp'] = $id_Emp;

            // Redireccionar según el id_Perm
            if ($id_Perm == 1) {
                header("Location: index2.php");
            } else {
                header("Location: index3.php");
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese correo electrónico.";
    }

    $stmt->close();
}

$conn->close();
?>*/


$dbConfig = array(
    'servername' => 'localhost',
    'username' => 'radiador_operador',
    'password' => '!9u?HW+^5N}4',
    'dbname' => 'radiador_taller'
);

// Crear la conexion utilizando los datos del array
$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Suponiendo que este es el código para el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_elec = $_POST['correo_elec'];
    $pass = $_POST['pass'];

    // Consulta para obtener la información del usuario con el correo proporcionado
    $sql = "SELECT nom_Pers, apell_Pers, correo_elec, pass, id_Tipo_Pers, id_Perm, id_Emp FROM Persona WHERE correo_elec = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $correo_elec);
    $stmt->execute();
    $stmt->bind_result($nom_Pers, $apell_Pers, $correo_elec, $hashed_pass, $id_Tipo_Pers, $id_Perm, $id_Emp);
    
    if ($stmt->fetch()) {
        // Verificar la contraseña
        if (password_verify($pass, $hashed_pass)) {
            // Iniciar sesión y almacenar los datos del usuario en la sesión
            session_start();
            $_SESSION['nom_Pers'] = $nom_Pers;
            $_SESSION['apell_Pers'] = $apell_Pers;
            $_SESSION['correo_elec'] = $correo_elec;
            $_SESSION['id_Tipo_Pers'] = $id_Tipo_Pers;
            $_SESSION['id_Perm'] = $id_Perm;
            $_SESSION['id_Emp'] = $id_Emp;

            // Redireccionar según el id_Perm
            if ($id_Perm == 1) {
                header("Location: index2.php");
            } else {
                header("Location: index3.php");
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese correo electrónico.";
    }

    $stmt->close();
}

$conn->close();
?>

