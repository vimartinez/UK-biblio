<?php
require_once 'app/inc/Vista.php';
final class Socios extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
    $resultados = $this->getData();
    $tabla = '<ul class="list">';
    if (isset($resultados[0][1])) {
        foreach ($resultados as $clave ) {
            $tabla = $tabla .'<li ><a href="#" title="'.$clave[2].'">'.$clave[1].'</a></li>';
        }
    }
    $tabla = $tabla . '</ul>';
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Contenido disponible para socios:</h2> '
                    .$tabla.
                '</div>
                ',
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
