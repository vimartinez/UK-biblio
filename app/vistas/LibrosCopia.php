<?php
final class LibrosCopia extends Vista {
    
protected $data2="";

public function mostrarHTML() {

    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $datos = $this->getData2();
    $msg = "<b>" . $datos[0][1] . "</b> Autor:<b>" . $datos[0][2] . "</b> ISBN:<b>" . $datos[0][6] . "</b> copia:<b>" . $datos[0][7] . "</b> Estado actual:<b>" . $datos[0][8] . "</b>";
    $idCopia = $datos[0][9];
    $idLibro  = $datos[0][0];
    $calle = $datos[0][10];
    $pasillo = $datos[0][11];
    $estante = $datos[0][12];
    $tabla = "";
    $sel = "";
    foreach ($resultados as $clave ) {
             if ( $datos[0][13] == $clave[0]) $sel = " selected ";
             $tabla = $tabla .'<option value="'.$clave[0].'" '.$sel.'>'.$clave[1].'</option>';
             $sel = "";
        }
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Libros:</h2>             
        <p>
           Detalle de Copia.<br />{datosCopia}
        </p>
         <p id="frmCopiaLibros">
         <form id="frmEstadoCopia" method="post" action="index.php"  >
            <ul class="form-style-1">
                <li>
                   <label>Estado:<span class="required">*</span></label>
                    <select name="frmEstadoCopia" class="field-long">
                    {estados}
                    </select>
                </li>
                <li>
                    <label>Ubicación (calle - pasillo - estante): </label>
                    <input type="text" name="frmCalle" class="field-triple" placeholder="Calle" required value={calle} >&nbsp;
                    <input type="text" name="frmPasillo" class="field-triple" placeholder="Pasillo" required value={pasillo} >&nbsp;
                    <input type="text" name="frmEstante" class="field-triple" placeholder="Estante" required value={estante} >
                    </li>
                </li>
                <li>
                 <input type="submit" value="Actualizar" id="frmActualizarEstado">
                 <input type="button" value="Volver" id="frmVolverLibro">
                </li>
                <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
                <input type="hidden" id="id" name="id" value="{idCopia}" >
                <input type="hidden" id="id" name="idLibro" value="{idLibro}" >
            </ul>
        </p>
        </form>
    </div>',
        'mensajeError'  => $this->getMensaje(),
        'infoUsuario'   => $this->getinfoUsu(),
        'estados'       => $tabla,
        'mensaje'       => $mensaje, 
        'error'         => $error,
        'datosCopia'    => $msg,
        'calle'         => $calle,
        'pasillo'       => $pasillo,
        'estante'       => $estante,
        'idCopia'       => $idCopia,
        'idLibro'       => $idLibro
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
