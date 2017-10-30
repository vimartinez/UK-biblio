<?php

final class ControladorLibros extends Controlador {

    public function gestionLibros($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $M = new ModeloLibros("");
        $res = $M->getLibros();
        $V = new Libros($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        $V->setData($res);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }

    public function detalleLibro($msg = null, $err = null, $copia = null) {
        $libroID = $_POST["id"];
        if (isset($copia)) $libroID = $copia->getidLibro();
        $res = array();
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $M = new ModeloLibros("");
        $res = $M->getLibrosDet($libroID);
        $V = new LibrosDet($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles del libro");
        }
        else {
            $V->setData($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addLibro($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $V = new LibrosAdd($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        $ma = new ModeloAutores("");
        $V->setData($ma->getAutores());
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function addLibroDo() {
        $libro = new LibrosClass(0,$_POST["frmAutor"],1,$_POST["frmISBN"],$_POST["frmNombre"],$_POST["frmGenero"],$_POST["frmSubgenero"],$_POST["frmEditorial"],$_POST["frmRes"]);
        $M = new ModeloLibros("");
        $res = $M->addLibro($libro,$_POST["frmCopias"]);
        if ($res == "ok"){
            $this->addLibro("Se guardó el libro correctamente.",null);
        }
        else{
            $this->addLibro(null, "No se pudo insertar el libro");
        }
    }
    public function delLibro() {
        $libro = new LibrosClass($_POST["id"]);
        $M = new ModeloLibros("");
        $res = $M->delLibro($libro);
        if ($res == "ok"){
            $this->gestionLibros("Se elimió el libro correctamente.",null);
        }
        else{
            $this->gestionLibros(null, "No se pudo eliminar el libro");
        } 
    }
     public function updEstadoCopia($msg = null, $err = null) { 
        $id = $_POST["id"];       
        $res = array();
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $M = new ModeloLibros("");
        $res = $M->getEstadosLibro();
        $V = new LibrosCopia($template, $scripts);
        if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles estados de copia libro");
        }
        else {
            $V->setData($res);
        }
        $res = $M->getCopia($id);
                if ($res[0] == "err"){
            $V->setError("No se pudieron recuperar los detalles de la copia");
        }
        else {
            $V->setData2($res);
        }
        $V->setinfoUsu($_SESSION['datosUsu']);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function updEstadoCopiaDo($msg = null, $err = null) {
        $C = new CopiasClass($_POST["id"],$_POST["frmEstadoCopia"],$_POST["frmCalle"],$_POST["frmPasillo"],$_POST["frmEstante"],$_POST["idLibro"]);
        $M = new ModeloLibros("");
        $res = $M->updCopia($C);
        if ($res == "ok"){
            $this->detalleLibro("Se modificó la copia correctamente.",null, $C);
        }
        else{
            $this->detalleLibro(null, "No se pudo actualizar el libro");
        }
    }
    public function imprimirEtiquetas ($msg = null, $err = null) {
        $idLibro = $_POST["id"]; 
        $res = array();
        $M = new ModeloLibros("");
        $res = $M->getLibro($idLibro);
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $V = new LibrosEtiquetas($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        $V->setData($res);
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    
    public function libroDet ($msg = null, $err = null) {
        $id = $_POST["id"];
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/catalogo.js"></script>';
        $V = new LibroDet($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        $M = new ModeloLibros("");
        $V->setData($M->getLibro($id));
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
    public function reservarLibro($msg = null, $err = null) {
        $id = $_POST["id"];
        $usu = $_SESSION['idUsuario'];
        $M = new ModeloLibros("");
        $res = $M->addReserva($id,$usu);
        $CP = new ControladorPrincipal();
        if ($res == "ok"){
            $CP->catalogo("Se generó la reserva correctamente.<br>Atención: La reserva estará disponible por 3 días habiles.",null);
        }
        else{
            $CP->catalogo(null, "No se pudo generar la reserva");
        }
    }
    public function reserva($msg = null, $err = null) {
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $V = new LibrosRes($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        $MA = new ModeloAutores("");
        $V->setData($MA->getAutores());
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
     public function libroAutocomplete(){
        $search = $_POST["term"];
        $res ="";
        $M = new ModeloLibros("");
        $res = $M->libroAutocomplete($search);
        echo json_encode($res);
    }
     public function getLibro($msg = null, $err = null){
        $libro = new LibrosClass(0,$_POST["frmAutor"],1,null,$_POST["frmNombrelibro"],null,null,null,null);
        $res = array();
        $template = file_get_contents('web/principal.html');
        $scripts = '<script src="web/js/libros.js"></script>';
        $V = new LibrosRes($template, $scripts);
        $V->setinfoUsu($_SESSION['datosUsu']);
        $M = new ModeloLibros("");
        $res = $M->getLibroRes($libro);
        if ($res[0] == "err"){
            $V->setMensaje("No se encontran libros con el criterio elegido.");
        }
        else {
            $V->setData2($res);
            $res = $M->getCopiasDisponibles($res[0][6]);
            if ($res[0] == "err"){
                $V->setMensaje("No se encontran copias disponibles para el libro elegido.");
            }
            else {
                $V->setCopias($res[0][0]);
            }
        }
        $MA = new ModeloAutores("");
        $V->setData($MA->getAutores());
        if ($err) $V->setError($err);
        if ($msg) $V->setMensaje($msg);
        $V->mostrarHTML();
    }
}

?>
