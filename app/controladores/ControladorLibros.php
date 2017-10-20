<?php

final class ControladorLibros extends Controlador {

    public function gestionLibros() {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $V = new Libros($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloLibros("");
            $res = $M->getLibros();
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }

    public function detalleLibro() {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $V = new LibrosDet($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloLibros("");
            $res = $M->getLibrosDet();
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }






    public function addAutor($err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new AutoresAdd($template, $scripts);
        if (isset($_SESSION['datosUsu'])){
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setMensaje($err);
        $V->mostrarHTML();
    }
    public function addAutorDo() {
        $aut = new Autores(0,$_POST["frmNombre"],$_POST["autPais"]);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloAutores("");
            $res = $M->addAutor($aut);
            if ($res[0] == "ok"){
                $this->gestionAutores();
            }
            else{
                $this->addAutor("No se pudo insertar el autor");
            }
            
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
    }
    public function delAutor() {
        $aut = new Autores($_POST["id"],null,null);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloAutores("");
            $res = $M->delAutor($aut);
            if ($res[0] == "ok"){
                $this->gestionAutores();
            }
            else{
                $this->addAutor("No se pudo eliminar el autor");
            }    
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
}

?>
