<?php
final class LibrosDet extends Vista {

public function mostrarHTML() {

    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    foreach ($resultados as $clave ) {
            switch ($clave[13]) {
                case "2":
                    $color = "#B3E4C7";
                    break;
                case "3":
                    $color = "#B7DBF3";
                    break;
                case "4":
                    $color = "#FCDCA9";
                    break;
                case "5":
                    $color = "#EBBAB5";
                    break;
                case "6":
                    $color = "#DBE1E1";
                    break;
                default:
                    $color = "#FFFFFF";
                    break;
            }
             $tabla = $tabla .' <tr id="'.$clave[9].'" bgcolor='.$color.' ><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td>'.$clave[3].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td>'.$clave[6].'</td><td>'.$clave[7].'</td><td>'.$clave[8].'</td><td>'.$clave[10].'</td><td>'.$clave[11].'</td><td>'.$clave[12].'</td><td><img src= ../web/img/page_edit.png id="updEstadoCopia" title="Cambiar estado de copia" style="cursor:pointer"  ></img></td></tr>';
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Libros:</h2>             
        <p>
           Detalle de libro.<br />
        </p>
         <p id="frmAltaLibros">
             <table style="width:80%" class="tabla-1" id="tablaLibrosDet">
             {mensaje}{error}
              <tr >
                <th>Nombre</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Subgénero</th>
                <th>Editorial</th>
                <th>ISBN</th>
                <th>Copia</th>
                <th>Estado</th>
                <th>Calle</th>
                <th>Pasillo</th>
                <th>Estante</th>
                <th> </th>
              </tr>
              {tablaLibros}
            </table>
            <br /> <br/>
            <ul class="form-style-1">
                <li>
                 <input type="button" value="Nuevo Libro" id="frmNuevoLibro">
                 <input type="button" value="Volver" id="frmVolverLibro">
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
