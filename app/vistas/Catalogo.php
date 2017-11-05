<?php
final class Catalogo extends Vista {
    
    protected $mensaje="";
    protected $data2 = null;

public function mostrarHTML() {
    $resultados =  $this->getData();
    $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
    $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
    $tabla = "";
    if ($resultados != null){
        foreach ($resultados as $clave ) {
            if ($this->getinfoUsu()!= ""){
                 $tabla = $tabla .' <tr style="cursor:pointer" id="'.$clave[0].'" ><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td>'.$clave[3].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td>'.$clave[6].'</td><td>'.$clave[8].'</td><td><img src= ../web/img/book_open.png id="detalleLibro" title="Ver Detalles" style="cursor:pointer" ></img></td><td><img src= ../web/img/book_go.png id="reservaLibro" title="Reservar libro" style="cursor:pointer" ></img></td></tr>';
            }
            else 
                {
                $tabla = $tabla .' <tr style="cursor:pointer" id="'.$clave[0].'" ><td>'.$clave[1].'</td><td>'.$clave[2].'</td><td>'.$clave[3].'</td><td>'.$clave[4].'</td><td>'.$clave[5].'</td><td>'.$clave[6].'</td><td>'.$clave[8].'</td><td><img src= ../web/img/book_open.png id="detalleLibro" title="Ver Detalles" style="cursor:pointer" ></img></td></tr>';
                }   
            }
    }
    $resultados2 =  $this->getData2();
    $tabla2 = "";
    foreach ($resultados2 as $clave ) {
             $tabla2 = $tabla2 .'<option value="'.$clave[0].'">'.$clave[1].'</option>';
        }



    $diccionario = array(
        'areaTrabajo' => '
            <div class="box">
                <h2>Catálogo</h2>
                <p>
                {mensaje}{error}
                    <form id="frmCatalogoLibro" method="post" action="index.php" >
                <ul class="form-style-1">
               <li>
                   <label>Datos Libro </span></label>
                   <input type="text" id="frmNombrelibro" name="frmNombrelibro" class="field-triple" placeholder="Nombre"  />&nbsp;
                    <select name="frmAutor" style="width: 150px;" class="field-triple">
                    <option value="0">Autor</option>
                    {Autores}
                    </select> &nbsp;<input type="text" id="frmEditorial" name="frmEditorial" class="field-triple" placeholder="Editorial" />
                </li>
                <li>
                <input type="text" name="frmGenero" id="frmGenero" class="field-triple" placeholder="Género" />&nbsp;
                <input type="text" name="frmSubgenero" id="frmSubgenero" class="field-triple" placeholder="Subgénero" />&nbsp;
                <input type="text" id="frmISBN" name="frmISBN" class="field-triple" placeholder="ISBN" />
            </li>
                <li>
                    <input type="submit" value="Buscar" id="frmBusquedaLibroCat">
                </li>
                <input type="hidden" id="metodo" name="metodo" value="" >
                <input type="hidden" id="controlador" name="controlador" value="" >
            </ul>
            </form>
                </p>

                <p id="frmAltaLibros">
                 <table style="width:80%" class="tabla-1" id="tablaLibros">
                  <tr >
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Subgénero</th>
                    <th>Editorial</th>
                    <th>ISBN</th>
                    <th>Disponibles</th>
                    <th> </th>
                    <th> </th>
                  </tr>
                  {tablaLibros}
                </table>
                <br /> <br/>

            </p>
        </div>',
        'mensajeError'  => $this->getMensaje(),
        'infoUsuario'   => $this->getinfoUsu(),
        'tablaLibros'   => $tabla,
        'mensaje'       => $mensaje, 
        'error'         => $error,
        'Autores'       => $tabla2,
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
    public function getData2() {
            return $this->data2;
        }

        public function setData2($data2) {
            $this->data2 = $data2;
        }


}
?>
