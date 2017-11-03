<?php
final class LibrosDevolucion extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {

    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Devolución de libros:</h2>             
         <p >
          <form id="frmLibroDev" method="post" action="index.php" name="id="frmLibroDev"" >
            <ul class="form-style-1">
            {mensaje}{error}
               <li>
                   <label>Escanear libro <span class="required">*</span></label>
                   <input type="text" id="codLibro" name="codLibro" class="field-divided" placeholder="Código de libro" required/> &nbsp; 
                   <input type="submit" value="Buscar" id="frmGuardarAutores">
                </li>
                <input type="hidden" id="metodo" name="metodo" value="devolucionDo" >
                <input type="hidden" id="controlador" name="controlador" value="ControladorLibros" >
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
