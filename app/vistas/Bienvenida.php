<?php
require_once 'app/inc/Vista.php';
final class Bienvendia extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
		$_SESSION = array();
        $diccionario = array(
            'Título de la página' => 'Correo Argentino - SIE',
            'mensajeError' => $this->getMensaje()
        );
        foreach ($diccionario as $clave=>$valor){
            $this->template = str_replace('{'.$clave.'}', $valor, $this->template);
        }
        print $this->template;
    } 
    public function getMensaje() {
        return $this->mensaje;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }


}
?>
