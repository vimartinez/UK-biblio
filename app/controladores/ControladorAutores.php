<?php

final class ControladorAutores extends Controlador {

    public function gestionAutores() {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new Autores($template, $scripts);
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
        $aut = new AutoresClass(0,$_POST["frmNombre"],$_POST["autPais"]);
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
        $aut = new AutoresClass($_POST["id"],null,null);
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
    public function autorAutocomplete(){
        $search = $_POST["term"];
        $mp = new ModeloPrincipal("");
        $conn = $mp->conectarBD();
        $res = array();
        $sql = "select id, nombre as value from paises where nombre like   '" . $search . "%'  ORDER BY nombre DESC";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        echo json_encode($res);
        $mp->desconectarBD($conn);
    }
}

?>
