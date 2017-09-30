<?php
require_once 'app/inc/Vista.php';
final class Login extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
		$_SESSION = array();
        $diccionario = array(
            'areaTrabajo' => '
                <div id="page">
                    <div class="box">
                        <h2>Ingreso al sistema:</h2>                
                        <p>
                            Solo para usuarios registrados<br />
                        </p>
                        <p id="frmlogin">
                            ee
                        </p>     
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
