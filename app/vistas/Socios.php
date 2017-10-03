<?php
require_once 'app/inc/Vista.php';
final class Socios extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
    $resultados =  $this->getData();
    if (isset($resultados[0][1])) {
        $tabla = '<ul class="list">';
        $primero = true;
        foreach ($resultados as $clave ) {
            if ($primero){
                 $tabla = $tabla .'<li class="first"><a href="#" title="'.$clave[2].'">'.$clave[1].'</a></li>';
                 $primero = false; 
            }
            else {
                 $tabla = $tabla .'<li ><a href="#" title="'.$clave[2].'">'.$clave[1].'</a></li>';
            }
        }
        $tabla = $tabla . '</ul>';
    }
    else {
        $tabla = $resultados;
    }
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
