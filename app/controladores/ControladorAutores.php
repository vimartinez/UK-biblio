<?php

require_once 'app/inc/Controlador.php';
require_once 'app/inc/constantes.php';
require_once 'app/inc/Autores.php';
require_once 'app/modelos/ModeloAutores.php';

final class ControladorAutores extends Controlador {

    
    public function gestionAutores() {
        require_once 'app/vistas/Autores.php';
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new AutoresV($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloAutores("");
            $res = $M->getAutores();
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function addAutor() {
        require_once 'app/vistas/AutoresAdd.php';
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new AutoresAdd($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloAutores("");
            $res = $M->getPaises();
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function addAutorDo() {

        $aut = new Autores(0,$_POST["frmNombre"],$_POST["frmNacionalidad"]);



        require_once 'app/vistas/Autores.php';
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new AutoresV($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloAutores("");
            $res = $M->addAutor($aut);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function delAutor() {
        var_dump($_POST);
      /*  require_once 'app/vistas/AutoresAdd.php';
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new Autores($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloAutores("");
            $res = $M->getPaises();
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();*/
    }
}

?>
