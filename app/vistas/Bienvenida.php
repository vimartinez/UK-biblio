<?php
final class Bienvenida extends Vista {
    
    protected $mensaje="";

public function mostrarHTML() {
        $diccionario = array(
            'areaTrabajo' => '
                     <div id="sidebar">
                        <div class="box">
                            <h3>Biblioteca virtual</h3>
                            <p>
                                Puede explorar nuestro catálogo con mas de 1000 artículos, monografías, ebooks y ensayos disponibles en castellano.
                            </p>
                        </div>
                        <div class="box">
                            <h3>Servicios</h3>
                            <ul class="list">
                                <li class="first"><a href="#">Alquiler de libros</a></li>
                                <li><a href="#">Catálogo online</a></li>
                                <li><a href="#">Administración de libros</a></li>
                                <li><a href="#">Adminisrtación de socios</a></li>
                            </ul>
                        </div>
                    </div>
                     <div id="content">
                        <div class="box">
                             <form id="frmPpal" name="frmPpal" action="index.php" method="post">
                                <input type="hidden" id="Controlador" name="Controlador" value="ControladorPrincipal" >
                                <input type="hidden" id="accion" name="accion" value="pantallaLogin" >
                                <div id="msgError" >{mensajeError}</div>
                            </form>
                            <h2>Bienvenidos a Biblio!</h2>
                            <img class="alignleft" src="web/img/pic01.jpg" alt="" />
                            <p>
                                Biblio! es un sistema de administración de bibliotecas, permite gestionar el catálogo, ingresar nuevos socios, registrar el préstamo y la devolución de libros físicos y visualizar contenidos digitales.
                            </p>
                        </div>
                        <div id="col1" class="box">
                            <h3>Préstamo de libros</h3>
                            <p>
                                Contamos con un servicio de préstamo de libros para nuestros socios. Hay más de 3000 libros disponibles
                            </p>
                            <ul class="list">
                                <li class="first"><a href="#">Más información</a></li>
                            </ul>
                        </div>
                        <div id="col2" class="box">
                            <h3>Hacete socio gratis</h3>
                            <p>
                                Asociate a nuestra biblioteca gratis, al asociarte tendrás un montón de beneficios, por ejemplo podrás retirar libros por un determinado tiempo. 
                            </p>
                            <ul class="list">
                                <li class="first"><a href="#">Más información</a></li>
                            </ul>
                        </div>
                        <br class="clearfix" />
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
