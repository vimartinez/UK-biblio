<?php
final class AutoresAdd extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Autores:</h2>             
        <p>
            Aquí se pueden gestionear los autores de libros - artículos, etc: <br />
        </p>
         <p id="frmAltaAutores">
          <form id="frmAutores" method="post" action="index.php" name="frmMenu" >
            <ul class="form-style-1">
            {mensaje}{error}
               <li>
                   <label>Nombre <span class="required">*</span></label>
                   <input type="text" id="frmNombre" name="frmNombre" class="field-long" required/>
                </li>
                <li>
                <label>País de nacimiento <span class="required">*</span></label>
                   <input type="text" id="frmNac" name="frmNac" class="field-long" required/>
                </li>
                <li>
                    <input type="submit" value="Guardar" id="frmGuardarAutores">
                    <input type="button" value="Volver" id="frmVolverAutores">
                </li>
                <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
                <input type="hidden" id="autPais" name="autPais" value="" >
            </ul>
            </form>
        </p>
    </div>
    ',
        'mensajeError' => $this->getMensaje(),
        'infoUsuario' => $this->getinfoUsu(),
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
