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
}

?>
