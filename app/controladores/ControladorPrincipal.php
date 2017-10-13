<?php

require_once 'app/inc/Controlador.php';
require_once 'app/inc/constantes.php';
require_once 'app/modelos/ModeloPrincipal.php';

final class ControladorPrincipal extends Controlador {




    public function bienvenida($error = null, $msg = null) {
        require_once 'app/vistas/Bienvenida.php';
        $M = new ModeloPrincipal("");
        $fecha = $M->getFecha();

        $template = file_get_contents('web/principal.html');
        $V = new Bienvenida($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);

        $V->mostrarHTML();
    }
      
      public function servicios($error = null, $msg = null) {
        require_once 'app/vistas/Servicios.php';
        $M = new ModeloPrincipal("");
        $fecha = $M->getFecha();

        $template = file_get_contents('web/principal.html');
        $V = new Servicios($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function catalogo($error = null, $msg = null) {
        require_once 'app/vistas/Catalogo.php';
        $M = new ModeloPrincipal("");
        $res = $M->getQuery();

        $template = file_get_contents('web/principal.html');
        $V = new Catalogo($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function links() {
        require_once 'app/vistas/Links.php';

        $template = file_get_contents('web/principal.html');
        $V = new Links($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function login() {
        require_once 'app/vistas/Login.php';

        $template = file_get_contents('web/principal.html');
        $V = new Login($template);
        if (isset($_SESSION['datosUsu'])){
            $V->setMensaje("ATENCIÓN: Usted ya ingresó la sistema, no es necesario volver a iniciar sesión.");
            $V->setinfoUsu($_SESSION['datosUsu']);
        } 
        $V->mostrarHTML();
    }

    public function loginDo() {
        $usr = $_POST["frmLoginUsu"];
        $clave = $_POST["frmLoginClave"];
        $M = new ModeloPrincipal("");
        $res = $M->iniciarSesion($usr,$clave);
        $template = file_get_contents('web/principal.html');
        if ($res != "ok"){
            require_once 'app/vistas/Login.php';
            $V = new Login($template);
            $V->setMensaje($res);
        }
        else {
            require_once 'app/vistas/Bienvenida.php';
            $V = new Bienvenida($template);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        $V->mostrarHTML();
    }

    public function contacto() {
        require_once 'app/vistas/Contacto.php';

        $template = file_get_contents('web/principal.html');
        $V = new Contacto($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function acercaDe() {
        require_once 'app/vistas/AcercaDe.php';
        $template = file_get_contents('web/principal.html');
        $V = new AcercaDe($template);
        if (isset($_SESSION['datosUsu'])) $V->setinfoUsu($_SESSION['datosUsu']);
        $V->mostrarHTML();
    }

    public function admin() {
        require_once 'app/vistas/Admin.php';
        $template = file_get_contents('web/principal.html');
        $V = new Admin($template);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloPrincipal("");
            $res = $M->getFuncionalidades($_SESSION['idPerfil']);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function socios() {
        require_once 'app/vistas/Socios.php';
        $template = file_get_contents('web/principal.html');
        $V = new Socios($template);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloPrincipal("");
            $res = $M->getFuncionalidades(3);
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
    public function salir() {
        require_once 'app/vistas/Bienvenida.php';
        session_destroy();

        $template = file_get_contents('web/principal.html');
        $V = new Bienvenida($template);
        $V->mostrarHTML();
    }
    public function gestionAutores() {
        require_once 'app/vistas/Autores.php';
        $template = file_get_contents('web/principal.html');
        $V = new Autores($template);
        if (isset($_SESSION['datosUsu'])){
            $M = new ModeloPrincipal("");
            $res = $M->getPaises();
            $V->setinfoUsu($_SESSION['datosUsu']);
        }
        else {
            $res = "Debe ingresar al sistema para visualizar estos contenidos";
        }
        $V->setData($res);
        $V->mostrarHTML();
    }
}

?>
