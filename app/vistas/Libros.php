<?php
final class Libros extends Vista {

public function mostrarHTML() {

    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    foreach ($resultados as $clave ) {
             $tabla = $tabla .' <tr style="cursor:pointer" id="'.$clave[6].'" ><td>'.$clave[0].'</td><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td>'.$clave[3].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td><img src= ../web/img/printer.png id="imprEtiquetas" title="Imprimir Etiquetas" style="cursor:pointer"  ></img></td><td><img src= ../web/img/delete.png id="delLibro" title="Eliminar todas las copias" style="cursor:pointer" alt="X" ></img></td></tr>';
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Libros:</h2>             
        <p>
           Listado de libros disponbles.<br />
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
                <th>Copias</th>
                <th> </th>
                <th> </th>
              </tr>
              {tablaLibros}
            </table>
            <br /> <br/>
            <ul class="form-style-1">
                <li>
                    <input type="button" value="Nuevo Libro" id="frmNuevoLibro">
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
