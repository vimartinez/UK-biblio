<?php
final class Autores extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    foreach ($resultados as $clave ) {
             $tabla = $tabla .' <tr id="'.$clave[0].'"><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td><img src= ../web/img/delete.png id="delAutor" title="Eliminar Autor" style="cursor:pointer" alt="X" ></img></td></tr>';
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Autores:</h2>             
        <p>
            Aquí se pueden gestionar los autores de libros - artículos, etc: <br />
        </p>
         <p id="frmAltaAutores">
             <table style="width:60%" class="tabla-1" id="tablaAutores">
             {mensaje}{error}
              <tr>
                <th>Nombre</th>
                <th>Pais de nacimiento</th>
                <th> </th>
              </tr>
              {tablaAutores}
            </table>
            <br /> <br/>
            <ul class="form-style-1">
                <li>
                    <input type="button" value="Nuevo Autor" id="frmNuevoAutor">
                    <input type="button" value="Volver" id="frmVolverStaff">
                </li>
            </ul>
        </p>
    </div>',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
        'tablaAutores' => $tabla,
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
