<?php
session_start();
if (isset($_SESSION['pp'])){
    $_SESSION['contador'] =0;
}
else {
    $_SESSION['contador'] =$_SESSION['contador']+1;
}
         
//session_write_close();

//Print_r ("sesionID:" . session_id() . "<br>");
//Print_r ($_SESSION);

if (!empty($_POST['controlador']))
        $controlador = $_POST['controlador'];
    else
        $controlador = "ControladorPrincipal";
if (!empty($_POST['metodo']))
    $metodo = $_POST['metodo'];
else
    $metodo = "bienvenida";

$controladorPath = "app/controladores/" . $controlador . '.php';
if (is_file($controladorPath))
    require $controladorPath;
else
    die("<br><br>No se encuentra el controlador $controlador.php - 404 not found");

if (is_callable(array($controlador, $metodo)) == false) 
    die("<br><br> No se encuentra el metodo <b>$metodo</b> en el controlador <b>$controlador</b>");

$ObjControlador = new $controlador();
$ObjControlador->$metodo();
?>