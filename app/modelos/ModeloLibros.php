<?php

final class ModeloLibros extends Modelo {


    public function getLibros(){
        $sql = "select l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial ,count(nombre)  
                from libros l inner join autores a on l.aut_id = a.aut_id 
                group by l.nombre; ;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "No se encontraron resultados";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getLibrosDet(){
        $sql = "select l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial, l.isbn , l.copiaNro , el.descripcion as Estado 
            from libros l  
            inner join autores a on l.aut_id = a.aut_id 
            inner join estados_libros el on l.est_id = el.est_id 
            where l.nombre = 'IT';";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "No se encontraron resultados";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }






    public function addLibro($Libro){
        $sql = "insert into autores values((select max(aut_ID) + 1 from autores au),'".$autor->getNombreApe()."','".$autor->getNacionalidad()."');";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res[] = "ok";
            } 
        else {  
            $res[] = "No se pudo insertar el autor";
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function delLibro($autor){
        $sql = "delete from autores where aut_id = ".$autor->getID()." ;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res[] = "ok";
            } 
        else {  
            $res[] = "err";
        }
       $this->desconectarBD($conn);
       return $res;
    }
}

?>
