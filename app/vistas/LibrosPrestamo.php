<?php
final class LibrosPrestamo extends Vista {
    protected $data2 = "";
    
    public function mostrarHTML() {
    $resultados =  $this->getData();
    $resultados2 =  $this->getData2();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    $datosSocio = "";
    if ($resultados != ""){
        echo "<pre>";
        echo print_r($resultados, true);
        echo "</pre>";
        //die(__FILE__ . " " . __LINE__);

        /* foreach ($resultados as $clave ) {
                 $tabla = $tabla .'<option value="'.$clave[0].'">'.$clave[1].'</option>';;
            }*/
    }
    if ($resultados2 != ""){
        echo "<pre>";
        echo print_r($resultados2, true);
        echo "</pre>";
       // die(__FILE__ . " " . __LINE__);
        }
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Gestión de Libros:</h2>             
        <p>
            Préstamo de libro: <br />
        </p>
         <p id="frmAltaLibros">
          <form id="frmSocio" method="post" action="index.php" >
            <ul class="form-style-1">
            {mensaje}{error}
               <li>
                   <label>Datos Socio <span class="required">*</span></label>
                   <input type="text" id="frmNro" name="frmNro" class="field-divided" placeholder="Número Socio" required/>&nbsp;
                   <input type="text" id="frmNombreSocio" name="frmNombreSocio" class="field-divided" placeholder="Nombre" required/>&nbsp;
                </li>
                <li>
                  <input type="submit" value="Buscar" id="frmBuscarSocio">
                  <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
                </li>
                </ul>
                </form>
                <p>
                    &nbsp; <br />
                    {datosSocio}
                </p>
                <form id="frmlibro" method="post" action="index.php" >
            <ul class="form-style-1">
                <li>
                    <label>Código de libro: <span class="required">*</span></label>
                    <input type="text" id="frmCopiaLibro" name="frmCopiaLibro" class="field-long" required />

                </li>
                <li>
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
        'error'         => $error,
        'datosSocio'    => $datosSocio

    );
    foreach ($diccionario as $clave=>$valor){
        $this->template = str_replace('{'.$clave.'}', $valor, $this->template);
    }
    print $this->template;
    } 
     public function getData2() {
        return $this->data2;
    }

    public function setData2($data2) {
        $this->data2 = $data2;
    }
}
?>
