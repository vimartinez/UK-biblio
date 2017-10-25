<?php

final class ModeloLibros extends Modelo {

    public function getLibros(){
       // $sql = "select l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial ,count(nombre)  
        //        from libros l inner join autores a on l.aut_id = a.aut_id 
        //        group by l.nombre; ;";
        $sql = "select l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.copias , l.lib_ID 
                from libros l 
                inner join autores a on l.aut_id = a.aut_id  
                where l.eliminado = 0 
                order by 1 ;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getLibrosDet($libroID){
        $sql = "select l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial, l.isbn , c.copia , el.descripcion as Estado , c.cop_id, c.calle, c.pasillo, c.estante, c.est_id
            from libros l  
            inner join autores a on l.aut_id = a.aut_id  
            inner join copias c on l.lib_ID = c.lib_ID
            inner join estados_libros el on c.est_id = el.est_id
            where l.lib_id = ".$libroID." 
            and l.eliminado = 0 
            order by copia asc;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[0] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }

    public function addLibro($libro,$copias){
        $res = "err";
        $conn = $this->conectarBD();  
        $sql = "insert into libros values(
            (select max(lib_ID) + 1 from libros li),".
            $libro->getAut_ID().",1,'".
            $libro->getIsbn()."','".
            $libro->getNombre()."','".
            $libro->getGenero()."','".
            $libro->getSubgenero()."','".
            $libro->getEditorial()."','".
            $libro->getResena()."','".
            $copias."',0);";
            if ($resultado = $conn->query($sql)) {
                for ($i=0;$i<$copias;$i++){
                    $copia = $i+1;
                    $sql = "insert into copias values(
                        (select max(cop_ID) + 1 from copias co),(select max(lib_ID) from libros),1,". $copia . ", null, null, null );";  
                        $resultado = $conn->query($sql);  
                    }
                $res = "ok";
                } 

       $this->desconectarBD($conn);
       return $res;
    }
    public function delLibro($libro){
        $sql = "update libros set eliminado = 1 where lib_id = ".$libro->getID()." ;";
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function getCopia($copiaID){
        $sql = "select l.lib_ID, l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial, l.isbn , c.copia , el.descripcion as Estado , c.cop_id, c.calle, c.pasillo, c.estante, c.est_id
            from libros l  
            inner join autores a on l.aut_id = a.aut_id  
            inner join copias c on l.lib_ID = c.lib_ID
            inner join estados_libros el on c.est_id = el.est_id
            where c.cop_id = ".$copiaID.";";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[0] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getEstadosLibro(){
        $sql = "select est_id, descripcion from estados_libros order by 1 ;";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function updCopia($copia){
        $sql = "update copias set 
                est_id = ".$copia->getEstado().", 
                calle = ".$copia->getCalle().", 
                pasillo = ".$copia->getPasillo().", 
                estante = ".$copia->getEstante()."  
                where cop_id = ".$copia->getID()." ;";
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function getLibro($id){
        $sql = "select l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.copias , l.lib_ID 
                from libros l 
                inner join autores a on l.aut_id = a.aut_id  
                where l.eliminado = 0 
                and l.lib_id = ".$id. ";";
        $res = array();
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "err";
            }
        }
       $this->desconectarBD($conn);
       return $res;
    }

}

?>
