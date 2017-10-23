<?php
final class LibrosAdd extends Vista {
    
public function mostrarHTML() {
    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    foreach ($resultados as $clave ) {
             $tabla = $tabla .'<option value="'.$clave[0].'">'.$clave[1].'</option>';;
        }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Gestión de Libros:</h2>             
        <p>
            Alta de libro: <br />
        </p>
         <p id="frmAltaLibros">
          <form id="frmAltaLibro" method="post" action="index.php" name="frmMenu" >
            <ul class="form-style-1">
            {mensaje}{error}
               <li>
                   <label>Datos Libro <span class="required">*</span></label>
                   <input type="text" id="frmNombre" name="frmNombre" class="field-divided" placeholder="Nombre" required/>&nbsp;
                    <select name="frmAutor" class="field-divided">
                    <option value="0">Autor</option>
                    {Autores}
                    </select>
                </li>
                <li>
                    <label>Cantidad de copias <span class="required">*</span></label>
                    <input type="text" name="frmCopias" class="field-long" required />

                </li>
                <li>
                    <label>Descripción </label>
                    <input type="text" name="frmGenero" class="field-divided" placeholder="Género" />&nbsp;
                    <input type="text" name="frmSubgenero" class="field-divided" placeholder="Subgénero" /></li>
                </li>
                <li>
                <label>Datos adicionales </label>
                   <input type="text" id="frmISBN" name="frmISBN" class="field-divided" placeholder="ISBN" />
                   <input type="text" id="frmEditorial" name="frmEditorial" class="field-divided" placeholder="Editorial" />
                </li>
                <li>
                    <label >Reseña</label>
                    <textarea name="frmRes" id="frmRes" class="field-long field-textarea"></textarea>
                </li>
                <li>
                    <input type="submit" value="Guardar" id="frmGuardarLibro">
                    <input type="button" value="Nuevo Autor" id="frmNuevoAutor">
                    <input type="button" value="Volver" id="frmVolverLibro">
                </li>
                <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
            </ul>
            </form>
        </p>
    </div>
    ',
        'mensajeError'  => $this->getMensaje(),
        'infoUsuario'   => $this->getinfoUsu(),
        'Autores'       => $tabla,
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
