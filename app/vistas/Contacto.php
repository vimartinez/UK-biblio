<?php
require_once 'app/inc/Vista.php';
final class Contacto extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
		$_SESSION = array();
        $diccionario = array(
            'areaTrabajo' => '
                <div id="page">
                    <div class="box">
                        <h2>Contacto:</h2>              
                        <p>
                            Dejanos tu consulta, responderemos a la brevedad... <br />
                        </p>
                        <p id="textoConsulta">
                            ee
                        </p>  
                    </div>
                </div>',
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
