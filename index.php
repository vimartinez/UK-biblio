<?php
session_start();

if (!empty($_POST['Controlador']))
        $controlador = $_POST['Controlador'];
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