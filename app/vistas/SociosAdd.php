<?php
final class SociosAdd extends Vista {
    
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
        <h2>Gestión de Socios:</h2>             
        <p>
            Alta de Socio: <br />
        </p>
         <p >
          <form id="frmAltaSocios2" method="post" action="index.php" >
            <ul class="form-style-1">
            {mensaje}{error}
                <li>
                    <label>Datos Personales <span class="required">*</span></label>
                    <input type="text" id="frmNombre" name="frmNombre" class="field-long" placeholder="Nombre" required />
                </li>
                 <li>
                   <input type="number" id="frmDNI" name="frmDNI" class="field-divided" placeholder="DNI" min="1000000" max="99000000" required/>&nbsp;
                   <input type="email" id="frmMail" name="frmMail" class="field-divided" placeholder="Mail" required/>
                </li>        
                <li>
                    <label>Datos Login <span class="required">*</span></label>
                    <input type="text" name="frmLogin" id="frmLogin" class="field-long" placeholder="Usuario" required />

                </li>
                <li>
                   <input type="password" id="frmClave" name="frmClave" class="field-divided" placeholder="Clave" required/>&nbsp;
                   <input type="password" id="frmClave2" name="frmClave2" class="field-divided" placeholder="Reingrese Clave" required/>
                </li>
                <li>
                   <label>Dirección <span class="required">*</span></label>
                   <input type="text" id="frmDireccion" name="frmDireccion" class="field-divided" placeholder="Calle y número" required/>&nbsp;
                   <input type="text" id="frmBarrio" name="frmBarrio" class="field-divided" placeholder="Barrio"/>
                   </li>
                <li>
                    <select name="frmProvincia" id="frmProvincia" class="field-divided">
                    <option value="0">Provincia</option>
                    {provincias}
                    </select>&nbsp;
                    <input type="text" id="frmLocalidad" name="frmLocalidad" class="field-divided" placeholder="Localidad" required/>
                </li>
                <li>
                    <input type="submit" value="Guardar" id="frmGuardarSocio2">
                    <input type="button" value="Volver" id="frmVolverSocio">
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
        'provincias'    => $tabla,
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
