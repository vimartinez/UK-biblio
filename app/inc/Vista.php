<?php

abstract class Vista {

    protected $template = null;
    protected $mensaje = null;


    public function __construct($template) {
        $this->template = $template;

    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function setTemplate($template) {
        $this->template = $template;
    }


    abstract public function mostrarHTML();
}

?>
