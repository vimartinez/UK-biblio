<?php
final class LibrosPrestamo extends Vista {
    protected $data2 = "";
    protected $data3 = "";
    protected $data4 = "";
    
    public function mostrarHTML() {
    $resultados =  $this->getData();
    $resultados2 =  $this->getData2();
    $resultados3 =  $this->getData3();
    $resultados4 =  $this->getData4();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    $datosSocio = "";
    $reservasActivas = "";
    if ($resultados != ""){
        $datosSocio = "  Socio:<b>" . $resultados[0][1] . "</b> DNI:" . $resultados[0][2];
        foreach ($resultados as $clave ) {
            if ($clave[7]!="" && $clave[11] < date()){
                $datosSocio = $datosSocio ."<br>SOCIO CON SANCIONES ACTIVAS - NO PUEDE SOLICITAR PRÉSTAMOS";
                }
            }
    }
    if ($resultados2 != ""){
        if (is_array($resultados2[0])){
            $reservasActivas = '<table style="width:800px" class="tabla-1" id="tablaLibrosPrest">
                      <tr >
                        <th>Reserva</th>
                        <th>Libro</th>
                        <th>Autor</th>
                        <th>ISBN</th>
                        <th>Copia</th>
                        <th>Reservado hasta</th>
                        <th>Calle</th>
                        <th>Pasillo</th>
                        <th>Estante</th>
                        <th> </th>
                        <th> </th>
                      </tr>';
             foreach ($resultados2 as $clave ) {
                     $reservasActivas = $reservasActivas .' <tr style="cursor:pointer" id="'.$clave[0].'" ><td>'.$clave[0].'</td><td>'.$clave[6].'</td><td>'.$clave[10].'</td><td>'.$clave[5].'</td><td>'.$clave[11].'</td><td>'.$clave[4].'</td><td>'.$clave[12].'</td><td>'.$clave[13].'</td><td>'.$clave[14].'</td><td><img src= ../web/img/book_go.png id="prestarLibro" title="Generar préstamo" style="cursor:pointer" ></img></td><td><img src= ../web/img/delete.png id="prestamoLibro" title="Eliminar reserva" style="cursor:pointer" ></img></td></tr>';
                }
             $reservasActivas = $reservasActivas . "</table>";
            }
        else{
            $reservasActivas = "<br>".$resultados2[0];
        }
    }
   if ($resultados3 != ""){
       foreach ($resultados3 as $clave ) {
                 $tabla = $tabla .'<option value="'.$clave[0].'">'.$clave[1].'</option>';
            }
   }
   if ($resultados4 != ""){
       echo "<pre>";
       echo print_r($resultados4, true);
       echo "</pre>";
       //die(__FILE__ . " " . __LINE__);
      }
    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Préstamo de Libros:</h2>             
         <p>
          <form id="frmSocio" method="post" action="index.php" >
            <ul class="form-style-1">
            {mensaje}{error}
               <li>
                   <label>Ingrese nombre o número de socio </span></label>
                   <input type="text" id="frmNro" name="frmNro" class="field-triple" placeholder="Número Socio" />&nbsp;
                   <input type="text" id="frmNombreSocio" name="frmNombreSocio" class="field-triple" placeholder="Nombre" />&nbsp;
                   <input type="submit" value="Buscar" id="frmBuscarSocio">
                    <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
                </li>
                </ul>
                </form>
                <p id="reservas" >
                <ul class="form-style-1">
                <li>
                       <label>Préstamo con reserva </label>
                       {datosSocio}                    
                    {reservasActivas}
                    </li>
                </ul>
                </p>
                <form id="frmlibroPrest" method="post" action="index.php" >
                <ul class="form-style-1">
                <li>
                       <label>Préstamo sin reserva <span class="required">*</span></label>
                       <input type="text" id="frmNombrelibro" name="frmNombrelibro" class="field-triple" placeholder="Nombre libro" required />&nbsp;
                        <select name="frmAutor" class="field-triple">
                        <option value="0">Autor</option>
                        {Autores}
                        </select>&nbsp;
                        <input type="submit" value="Buscar" id="frmBuscarLibroPrest">
                    </li>
                <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >

            </ul>
            </form>
        </p>
    </div>
    ',
        'mensajeError'      => $this->getMensaje(),
        'infoUsuario'       => $this->getinfoUsu(),
        'Autores'           => $tabla,
        'mensaje'           => $mensaje, 
        'error'             => $error,
        'datosSocio'        => $datosSocio,
        'reservasActivas'   => $reservasActivas

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
     public function getData3() {
        return $this->data3;
    }

    public function setData3($data3) {
        $this->data3 = $data3;
    }
     public function getData4() {
        return $this->data4;
    }

    public function setData4($data4) {
        $this->data4 = $data4;
    }
}
?>
