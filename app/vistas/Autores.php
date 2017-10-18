<?php
require_once 'app/inc/Vista.php';
final class Autores extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

$resultados =  $this->getData();
        $tabla = "";
        foreach ($resultados as $clave ) {
                 $tabla = $tabla .' <tr id="'.$clave[0].'"><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td><img src= ../web/img/delete-1-icon.png id="delAutor" title="Eliminar Autor" alt="X" height="20" width="20"></img></td></tr>';
            }

        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
            <h2>Administración de Autores:</h2>             
            <p>
                Aquí se pueden gestionear los autores de libros - artículos, etc: <br />
            </p>
             <p id="frmAltaAutores">
                 <table style="width:80%" class="form-style-1" id="tablaAutores">
                  <tr>
                    <th>Nombre</th>
                    <th>Pais de nacimiento</th>
                    <th> </th>
                  </tr>
                  {tablaAutores}
                </table>
                <ul class="form-style-1">
                    <li>
                        <input type="button" value="Nuevo Autor" id="frmNuevoAutor">
                    </li>
                </ul>
            </p>
        </div>',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu(),
            'tablaAutores' => $tabla

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