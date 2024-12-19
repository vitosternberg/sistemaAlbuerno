<?php
require 'conexion.php';

function ejecutarConsulta($sql, $parametros, $tipos) {
    global $conn;
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }
    $stmt->bind_param($tipos, ...$parametros);
    $stmt->execute();
    return $stmt;
}

function crearCliente($nom_Pers, $apell_Pers, $correo_elec, $pass, $id_Tipo_Pers, $id_Perm, $id_Emp) {
    $sql = "INSERT INTO Persona (nom_Pers, apell_Pers, correo_elec, pass, id_Tipo_Pers, id_Perm, id_Emp) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $parametros = [$nom_Pers, $apell_Pers, $correo_elec, password_hash($pass, PASSWORD_DEFAULT), $id_Tipo_Pers, $id_Perm, $id_Emp];
    return ejecutarConsulta($sql, $parametros, 'ssssssi');
}

function modificarCliente($id_Pers, $nom_Pers, $apell_Pers, $correo_elec) {
    $sql = "UPDATE Persona SET nom_Pers = ?, apell_Pers = ?, correo_elec = ? WHERE id_Pers = ?";
    $parametros = [$nom_Pers, $apell_Pers, $correo_elec, $id_Pers];
    return ejecutarConsulta($sql, $parametros, 'sssi');
}

function eliminarCliente($id_Pers) {
    $sql = "DELETE FROM Persona WHERE id_Pers = ?";
    $parametros = [$id_Pers];
    return ejecutarConsulta($sql, $parametros, 'i');
}
?>
