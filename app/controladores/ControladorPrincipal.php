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
        if ($error) $V->setMensaje(utf8_encode($msg));
        $V->mostrarHTML();
    }
      
      public function servicios($error = null, $msg = null) {
        require_once 'app/vistas/Servicios.php';
        $M = new ModeloPrincipal("");
        $fecha = $M->getFecha();

        $template = file_get_contents('web/principal.html');
        $V = new Servicios($template);
        if ($error) $V->setMensaje(utf8_encode($msg));
        $V->mostrarHTML();
    }

    public function catalogo($error = null, $msg = null) {
        require_once 'app/vistas/Catalogo.php';
        $M = new ModeloPrincipal("");
        $res = $M->getQuery();

        $template = file_get_contents('web/principal.html');
        $V = new Catalogo($template);
        if ($error) $V->setMensaje(utf8_encode($msg));
        $V->mostrarHTML();
    }

    public function links() {
        require_once 'app/vistas/Links.php';

        $template = file_get_contents('web/principal.html');
        $V = new Links($template);
        $V->mostrarHTML();
    }
    public function login() {
        require_once 'app/vistas/Login.php';

        $template = file_get_contents('web/principal.html');
        $V = new Login($template);
        $V->mostrarHTML();
    }
    public function contacto() {
        require_once 'app/vistas/Contacto.php';

        $template = file_get_contents('web/principal.html');
        $V = new Contacto($template);
        $V->mostrarHTML();
    }
    public function acercaDe() {
        require_once 'app/vistas/AcercaDe.php';

        $template = file_get_contents('web/principal.html');
        $V = new AcercaDe($template);
        $V->mostrarHTML();
    }
    public function admin() {
        require_once 'app/vistas/Admin.php';

        $template = file_get_contents('web/principal.html');
        $V = new Admin($template);
        $V->mostrarHTML();
    }
}

?>
