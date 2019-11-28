<?php
final class SociosSancion extends Vista {
    protected $data2 = null;
    protected $idSocio = 0;
    public function mostrarHTML() {
        $resultados =  $this->getData();
        $mensaje =  ($this->getMensaje() != "" ? $this->mostrarMensaje($this->getMensaje()) : "");
        $error = ($this->getError() != "" ? $this->mostrarError($this->getError()) : "");
        $datosSocio = "";
        if ($resultados != ""){
            $this->setIdSocio($resultados[0][0]);
             $datosSocio = "  Socio:<b>" . $resultados[0][1] . "</b> DNI:" . $resultados[0][2];
        }

        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
            <h2>Sanción a socios:</h2>             
             <p >
              <form id="frmSocioSancion" method="post" action="index.php" >
                <ul class="form-style-1">
                {mensaje}{error}
                   <li>
                       <label>Datos socio</label>
                       <input type="text" id="id" name="id" class="field-triple" placeholder="Número de socio"  />&nbsp;
                       <input type="text" id="frmNombreSocio" name="frmNombreSocio" class="field-triple" placeholder="Nombre del socio"  />&nbsp;
                       <input type="submit" value="Buscar" id="frmBusquedaSocio">
                    </li>            
                    <input type="hidden" id="metodo" name="metodo" value="" >
                    <input type="hidden" id="controlador" name="controlador" value="" >
                    <input type="hidden" id="idSocio" name="idSocio" value="{idSocio}" >
                    <br>{datosSocio}
                </ul>
                <br>
                
                <ul class="form-style-1" style="max-width: 800px;">
                <li>
                    <label>Seleccione el tipo de sanción <span class="required">*</span></label>
                    <select name="frmSancion" class="field-divided">
                    <option value="0">Seleccione</option>
                    <option value="5">5 días</option>
                    <option value="15">15 días</option>
                    <option value="30">30 días</option>
                    <option value="60">60 días</option>
                    <option value="90">90 días</option>
                    </select>&nbsp;
                    <input type="submit" value="Generar Sanción" id="frmSancionSocio">
                </li>
                </form>
            </p>
        </div>
        ',
            'mensajeError'  => $this->getMensaje(),
            'infoUsuario'   => $this->getinfoUsu(),
            'mensaje'       => $mensaje, 
            'error'         => $error,
            'datosSocio'    => $datosSocio,
            'idSocio'       => $this->getIdSocio()
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
        public function getIdSocio() {
            return $this->idSocio;
        }

        public function setIdSocio($idSocio) {
            $this->idSocio = $idSocio;
        }
}
?>
