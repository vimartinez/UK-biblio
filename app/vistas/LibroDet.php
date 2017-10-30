<?php
final class LibroDet extends Vista {

public function mostrarHTML() {
    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    $idLibro2 = "";
    foreach ($resultados as $clave ) {
             $idLibro2 =$clave[6];
             $tabla = $tabla .' <tr ><td>'.$clave[0].' - '.$clave[1].'</td></tr></tr>
                                <tr ><td>'.$clave[2].' '.$clave[3].'</td></tr>
                                <tr ><td>'.$clave[4].'</td></tr>
                                <tr ><td>'.$clave[7].'</td></tr>';
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Catálogo:</h2>             
        <p>
           Reserva de libro.<br />
        </p>
         <p >
             <table style="width:80%" class="tabla-1" id="tablaLibroDet">
             {mensaje}{error}
              <tr >
                <th>Detalle de libro</th>
              </tr>
              {tablaLibros}
            </table>
            <br /> <br/>
            <ul class="form-style-1">
                <li>
                 <input type="button" value="Reservar" id="frmReservar">
                 <input type="button" value="Volver" id="frmVolverCatalogo">
                 <input type="hidden" id="idLibr"  value="'.$idLibro2.'" >
                </li>
            </ul>
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

}
?>
