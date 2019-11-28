<?php
final class LibrosRes extends Vista {
    protected $data2 = null;
    protected $copias = 0;
    public function mostrarHTML() {
        $resultados =  $this->getData();
        $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
        $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
        $tabla = "";
        $idLibro = "";
        $btnReservar = "";
        foreach ($resultados as $clave ) {
                 $tabla = $tabla .'<option value="'.$clave[0].'">'.$clave[1].'</option>';
            }

        $resultados2 =  $this->getData2();
        $tabla2 = "";
        if ($resultados2 != ""){
            $tabla2 ="<b>" .$resultados2[0][0].' - '.$resultados2[0][1]. '</b> copias disponibles:<b>' . $this->getCopias()."</b>";
            $idLibro = $resultados2[0][6];
            if ($this->getCopias() > 0){
                $btnReservar = '<input type="button" value="Reservar" id="frmReservarLibro">';
            }
            else {
                $tabla2 = $tabla2 . "<br>No hay copias diasponibles, no se podrá realizar la reserva.";
            }
        }
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
            <h2>Reserva de Libros:</h2>             
            <p>
                 {libro}  <br /> 
            </p>
             <p >
              <form id="frmReservaLibro" method="post" action="index.php" >
                <ul class="form-style-1">
                {mensaje}{error}
                   <li>
                       <label>Datos Libro <span class="required">*</span></label>
                       <input type="text" id="frmNombrelibro" name="frmNombrelibro" class="field-divided" placeholder="Nombre" required />&nbsp;
                        <select name="frmAutor" class="field-divided">
                        <option value="0">Autor</option>
                        {Autores}
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Buscar" id="frmBusquedaLibro">
                        <input type="button" value="Volver" id="frmVolverLibro">
                        {reservar}
                    </li>
                    <input type="hidden" id="metodo" name="metodo" value="" >
                    <input type="hidden" id="controlador" name="controlador" value="" >
                    <input type="hidden" id="ID" name="ID" value="{idlibro}" >
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
            'libro'         => $tabla2,
            'reservar'      => $btnReservar,
            'idlibro'       => $idLibro
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
        public function getCopias() {
            return $this->copias;
        }

        public function setCopias($copias) {
            $this->copias = $copias;
        }
}
?>
