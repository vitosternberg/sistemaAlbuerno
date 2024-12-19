<?php
session_start();
//require 'funciones.php';

echo $nom_Pers = $_POST['nom_Pers'];
echo  $apell_Pers = $_POST['apell_Pers'];
echo $correo_elec = $_POST['correo_elec'];
echo $pass = $_POST['pass'];
echo $id_Tipo_Pers = $_POST['id_Tipo_Pers'];
echo $id_Perm = $_POST['id_Perm'];
echo $id_Emp = $_POST['id_Emp'];


// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    
    if ($accion == "crear") {
        $nom_Pers = $_POST['nom_Pers'];
        $apell_Pers = $_POST['apell_Pers'];
        $correo_elec = $_POST['correo_elec'];
        $pass = $_POST['pass'];
        $id_Tipo_Pers = $_POST['id_Tipo_Pers'];
        $id_Perm = $_POST['id_Perm'];
        $id_Emp = $_POST['id_Emp'];
        
        if (!existeCorreo($correo_elec)) {
            crearCliente($nom_Pers, $apell_Pers, $correo_elec, $pass, $id_Tipo_Pers, $id_Perm, $id_Emp);
            header("Location: index.php");
            exit();
        } else {
            echo "El correo electrónico ya está registrado.";
        }
    } elseif ($accion == "modificar") {
        $id_Pers = $_POST['id_Pers'];
        $nom_Pers = $_POST['nom_Pers'];
        $apell_Pers = $_POST['apell_Pers'];
        $correo_elec = $_POST['correo_elec'];
        
        modificarCliente($id_Pers, $nom_Pers, $apell_Pers, $correo_elec);
        header("Location: index.php");
        exit();
    } elseif ($accion == "eliminar") {
        $id_Pers = $_POST['id_Pers'];
        
        eliminarCliente($id_Pers);
        header("Location: index.php");
        exit();
    }
}

function existeCorreo($correo_elec) {
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
    
    $sql = "SELECT 1 FROM Persona WHERE correo_elec = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("s", $correo_elec);
    $stmt->execute();
    
    $stmt->bind_result($exists);
    $stmt->fetch();
    
    $stmt->close();
    $conn->close();
    
    return $exists ? true : false;
}

function crearCliente($nom_Pers, $apell_Pers, $correo_elec, $pass, $id_Tipo_Pers, $id_Perm, $id_Emp) {
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

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Persona (nom_Pers, apell_Pers, correo_elec, pass, id_Tipo_Pers, id_Perm, id_Emp) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("ssssssi", $nom_Pers, $apell_Pers, $correo_elec, $hashed_pass, $id_Tipo_Pers, $id_Perm, $id_Emp);

    if ($stmt->execute()) {
        echo "Nuevo cliente creado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}

function modificarCliente($id_Pers, $nom_Pers, $apell_Pers, $correo_elec) {
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
    
    $sql = "UPDATE Persona SET nom_Pers = ?, apell_Pers = ?, correo_elec = ? WHERE id_Pers = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nom_Pers, $apell_Pers, $correo_elec, $id_Pers);
    
    if ($stmt->execute()) {
        echo "Cliente modificado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}

function eliminarCliente($id_Pers) {
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
    
    $sql = "DELETE FROM Persona WHERE id_Pers = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("i", $id_Pers);
    
    if ($stmt->execute()) {
        echo "Cliente eliminado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
