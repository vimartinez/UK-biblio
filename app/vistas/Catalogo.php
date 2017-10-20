<?php
final class Catalogo extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                    <div class="box">
                        <h2>Catálogo</h2>
                        <p>
                            Listado publicaciones disponibles<br />
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
