<?php include("./layout/plantilla.php");?>

<?php
session_start();
//index2.php
//Verificar si la sesion esta activa
if (!isset($_SESSION['correo_elec'])) {
    header("Location: index.html");
    exit();
}
?>
<?php include ("./layout/cabecera.php");?>
<div class="container">
<?php  include("./layout/nav2.php");?>
</div>
<div class="container">
        <div class="flex flex-wrap">
            <div class="w-full bg-white p-4">
             <?php include ("./ORDENES/visor_cliente.php");?>
            </div>
        </div>
</div>
