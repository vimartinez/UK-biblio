<?php
require_once 'app/inc/Vista.php';
final class Autores extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

$resultados =  $this->getData();
        $tabla = "";
        foreach ($resultados as $clave ) {
                 $tabla = $tabla .'<OPTION VALUE="'.$clave[0].'">'.$clave[1].'</OPTION>';;
            }

        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
            <h2>Administración de Autores:</h2>             
            <p>
                Aquí se pueden gestionear los autores de libros - artículos, etc: <br />
            </p>
             <p id="frmAltaAutores">
                <ul class="form-style-1">
                   <li>
                       <label>Nombre <span class="required">*</span></label>
                       <input type="text" id="frmNombre" name="frmNombre" class="field-long" required/>
                    </li>
                    <li>
                    <label>Nacionalidad <span class="required">*</span></label>
                       <SELECT NAME="nacionalidad" class="field-long">
                            {paises}
                        </SELECT>
                    </li>
                    <li>
                        <input type="button" value="Guardar" id="frmEnviar">
                    </li>
                    <input type="hidden" id="metodo" name="metodo" value="" >
                    <input type="hidden" id="controlador" name="controlador" value="" >
                </ul>
            </p>
        </div>',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu(),
            'paises' => $tabla

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
