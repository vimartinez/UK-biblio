<?php

final class ControladorAutores extends Controlador {

    public function gestionAutores($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new Autores($template, $scripts);
        $M = new ModeloAutores("");
        $res = $M->getAutores();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron autores en el sistema");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addAutor($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/autores.js"></script>';
        $V = new AutoresAdd($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addAutorDo() {
        $aut = new AutoresClass(0,$_POST["frmNombre"],$_POST["autPais"]);
        $M = new ModeloAutores("");
        $res = $M->addAutor($aut);
        if ($res == "ok"){
            $this->addAutor("Se agregó el autor correctamente",null);
        }
        else{
            $this->addAutor(null,"No se pudo insertar el autor");
        }
        
    }
    public function delAutor() {
        $aut = new AutoresClass($_POST["id"],null,null);
        $M = new ModeloAutores("");
        $res = $M->delAutor($aut);
        if ($res == "ok"){
            $this->gestionAutores("Se eliminó el autor",null);
        }
        else{
            $this->gestionAutores(null,"No se pudo eliminar el autor");
        }    
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
