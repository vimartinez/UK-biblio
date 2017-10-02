<?php
require_once 'app/inc/Vista.php';
final class Socios extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
    $resultados = $this->getData();
    $tabla = '<table style="width:70%">
                  <tr>
                    <th>Nombre</th> 
                    <th>Comentario</th>
                  </tr>';
    if (isset($resultados[1])) {
        foreach ($resultados as $clave ) {
            $tabla = $tabla ."<tr>
                                <td>$clave[1]</td> 
                                <td>$clave[2]</td>
                              </tr>";
        }
    }
    $tabla = $tabla . '</table>';
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Contenido disponible para socios:</h2>              
                    <p>
                        Para asociarte x... <br />
                    </p> '
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
