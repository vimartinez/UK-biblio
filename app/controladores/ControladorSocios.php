<?php

final class ControladorSocios extends Controlador {

    public function gestionSocios($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $V = new SociosGestion($template, $scripts);
        $M = new ModeloSocios("");
        $res = $M->getSocios();
        if ($res[0]== "err"){
            $V->setMensaje("No se encontraron Socios en el sistema");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addSocio($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/socios.js"></script>';
        $res = array();
        $M = new ModeloSocios("");
        $res = $M->getProvincias();
        $V = new SociosAdd($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar las provincias");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
     public function socioAutocomplete(){
        $search = $_POST["term"];
        $res ="";
        $M = new ModeloSocios("");
        $res = $M->socioAutocomplete($search);
        echo json_encode($res);
    }
    public function addSocioDo() {
        $soc = new UsuariosClass(
                    0,
                    $_POST["frmNombre"],
                    $_POST["frmDNI"],
                    $_POST["frmMail"],
                    $_POST["frmLogin"],
                    $_POST["frmClave"],
                    $_POST["frmDireccion"],
                    $_POST["frmBarrio"],
                    $_POST["frmProvincia"],
                    $_POST["frmLocalidad"],
                    3
                );
        $M = new ModeloSocios("");
        $res = $M->addSocio($soc);
        if ($res == "ok"){
            $this->gestionSocios("Se agregó el socio correctamente",null);
        }
        else{
            $this->gestionSocios(null,"No se pudo insertar el autor");
        } 
    }
    public function delSocio() {
        $usu = new UsuariosClass($_POST["id"]);
        $M = new ModeloSocios("");
        $res = $M->delSocio($usu);
        if ($res == "ok"){
            $this->gestionSocios("Se eliminó el socio",null);
        }
        else{
            $this->gestionSocios(null,"No se pudo eliminar el socio");        
        }    
    }
}

?>
