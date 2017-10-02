<?php
require_once 'app/inc/Vista.php';
final class Admin extends Vista {
    
protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                <div class="box">
                    <h2>Herramientas Administrativas</h2>
                    <div id="contenidoNoLogin" >  
                        <p >
                            <h2>Acceso exclusivo para empleados de la biblioteca</h2><br /><br />
                           Debe ser un usuario registrado para acceder a estos contenidos <br /> &nbsp; <br />
                       

                        </p>
                    </div>
                    <div id="contenidoLogin"  >   
                        <div class="box">
                            <h3>Opciones de administrador</h3>
                            <ul class="list">
                                <li class="first"><a href="#">Gestión de usuarios</a></li>
                                <li><a href="gestionLibros.aspx">Gestión de catálogo</a></li>
                                <li><a href="PrestamoLibros.aspx">Préstamo de libros</a></li>
                                <li><a href="verConsultas.aspx">Revisar Consultas</a></li>
                                <li><a href="#">Devolución de libros</a></li>
                                <li><a href="#">Listado de libros en biblioteca</a></li>
                                <li><a href="#">Listado de libros prestados</a></li>
                                <li><a href="#">Listado de socios deudores</a></li>
                            </ul>
                        </div>
                    </div>
                </div>',
            'mensajeError' => $this->getMensaje(),
            'infoUsuario' => $this->getinfoUsu()
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
