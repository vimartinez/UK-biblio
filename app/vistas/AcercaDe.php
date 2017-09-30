<?php
require_once 'app/inc/Vista.php';
final class AcercaDe extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
		$_SESSION = array();
        $diccionario = array(
            'areaTrabajo' => '
                <div id="page">
                    <div class="box">
                        <h2>Acerca de...</h2>     
                        <p>
                            <h2>Biblio! 1.0</h2>
                            Trabajo final integrador para Lenguaje de programación V (febrero 2016) <br />
                            Desarrollado en C# con SQLServer <br /><br />
                            <h2>Biblio! 2.0</h2>
                            Rediseñado y mejorado para Práctica Profesional (Noviembre 2017)<br />
                            Desarrollado con PHP y MySQL <br /><br />
                            <img class="alignleft" src="web/img/logo2.png" alt="Universidad Kennedy" /><br /> <br /> 
                            <br /><br />
                           <h3> Victor Martinez</h3> <br /><br /><br />
                            Marzo 2016 - Noviembre 2017

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
