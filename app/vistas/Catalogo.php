<?php
final class Catalogo extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    foreach ($resultados as $clave ) {
             $tabla = $tabla .' <tr style="cursor:pointer" id="'.$clave[0].'" ><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td>'.$clave[3].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td>'.$clave[6].'</td><td>'.$clave[8].'</td><td><img src= ../web/img/book_open.png id="detalleLibro" title="Ver Detalles" style="cursor:pointer" ></img></td><td><img src= ../web/img/book_go.png id="reservaLibro" title="Reservar libro" style="cursor:pointer" ></img></td></tr>';
        }

        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Catálogo</h2>
                    <p>
                        Listado publicaciones disponibles<br />
                    </p>
                    <p id="frmAltaLibros">
                     <table style="width:80%" class="tabla-1" id="tablaLibros">
                     {mensaje}{error}
                      <tr >
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Género</th>
                        <th>Subgénero</th>
                        <th>Editorial</th>
                        <th>ISBN</th>
                        <th>Disponibles</th>
                        <th> </th>
                        <th> </th>
                      </tr>
                      {tablaLibros}
                    </table>
                    <br /> <br/>
                    
                </p>
            </div>',
            'mensajeError'  => $this->getMensaje(),
            'infoUsuario'   => $this->getinfoUsu(),
            'tablaLibros'   => $tabla,
            'mensaje'       => $mensaje, 
            'error'         => $error
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
