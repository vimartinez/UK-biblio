<?php
final class Links extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Links</h2>      
                    <p>
                        Otras bibliotecas interesantes... <br />
                    </p>
                    <img class="alignleft" src="web/img/pic02.jpg" alt="" />        
                    <ul class="list">
                        <li class="first"><a href="http://www.bn.gov.ar/" target="_blank">Biblioteca Nacional</a></li>
                        <li><a href="http://www.bcnbib.gov.ar/" target="_blank">Biblioteca del Congreso de la Nación</a></li>
                        <li><a href="http://library.princeton.edu/" target="_blank">Biblioteca Universidad de Princeton</a></li>
                        <li><a href="http://libraries.mit.edu/" target="_blank">Biblioteca del MIT</a></li>
                        <li><a href="http://www.lib.washington.edu/" target="_blank">Biblioteca Universidad de Washington</a></li>
                    </ul>        
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
