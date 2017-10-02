<?php
require_once 'app/inc/Vista.php';
final class Contacto extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Contacto:</h2>              
                    <p>
                        Dejanos tu consulta, responderemos a la brevedad... <br />
                    </p>
                    <p id="textoConsulta">
                        ee
                    </p>  
                </div>',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu()
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
