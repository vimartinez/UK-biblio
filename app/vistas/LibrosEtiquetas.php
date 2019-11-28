<?php
//include "app/inc/Barcode2.php";

final class LibrosEtiquetas extends Vista {

public function mostrarHTML() {
    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    for ($i=0; $i < $resultados[0][5] ; $i++) {
        $copia = $i+1;
        $codBarra = str_pad($resultados[0][6], 6, "0", STR_PAD_LEFT) . str_pad($copia, 3, "0", STR_PAD_LEFT);
        $tabla = $tabla .'
             <table  class="tabla-etiquetas" id="tablaEtiquetas">
               <tr>
                <td>'.$resultados[0][0].' - '.$resultados[0][1].'</td>
               </tr>
               <tr>
                <td>Editorial: '.$resultados[0][4].'</td>
               </tr>
               <tr>
                <td>Copia '.$copia.'</td>
               </tr>
               <tr>
                <td id="codBarra"> <img src="app/inc/codBarra.php?num='.$codBarra.'" alt="'.$codBarra.'" ></td>
               </tr>
               <tr>
                <td> '.$codBarra.'</td>
               </tr>
              </table><br>';
    }

    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
        <h2>Administración de Libros:</h2>             
        <p>
           Etiquetas.<br />
        </p>
         <p id="frmAltaLibros">
             
             {mensaje}{error}
              {etiquetas}
            
            <br /> 
            <ul class="form-style-1">
                <li>
                    <input type="button" value="Imprimir" onClick=window.print();>
                    <input type="button" value="Volver" id="frmVolverLibro">
                </li>
            </ul>
        </p>
    </div>',
        'mensajeError'  => $this->getMensaje(),
        'infoUsuario'   => $this->getinfoUsu(),
        'etiquetas'     => $tabla,
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
