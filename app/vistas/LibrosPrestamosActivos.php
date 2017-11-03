<?php
final class LibrosPrestamosActivos extends Vista {

public function mostrarHTML() {

    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    
    if ($resultados != ""){
        foreach ($resultados as $clave ) {
                 $tabla = $tabla .' <tr style="cursor:pointer" id="'.$clave[0].'" ><td>'.$clave[1].'</td><td>'.$clave[9].'</td><td>'.$clave[2].'-'.$clave[7].'</td><td>'.$clave[8].'</td><td>'.$clave[10].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td><img src= ../web/img/printer.png id="imprEtiquetas" title="Sancionar Socio" style="cursor:pointer"  ></img></td></tr>';
            }
    }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Reporte de préstamos:</h2>             
         <p >
             <table style="width:80%" class="tabla-1" id="tablaPrestamosActivos">
             {mensaje}{error}
              <tr >
                <th>Socio</th>
                <th>Nombre</th>
                <th>Libro</th>
                <th>Autor</th>
                <th>Copia</th>
                <th>Prestado Desde</th>
                <th>Prestado Hasta</th>
                <th> </th>
              </tr>
              {tablaLibros}
            </table>
            <br /> <br/>
            <ul class="form-style-1">
                <li>
                    <input type="button" value="Volver" id="frmVolverStaff">
                </li>
            </ul>
        </p>
    </div>',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
        'tablaLibros' => $tabla,
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
