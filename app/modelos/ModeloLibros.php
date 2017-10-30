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
        $sql = "select l.nombre, a.nombreApe, l.genero, l.subgenero, l.editorial , l.copias , l.lib_ID, l.resena, l.isbn 
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
    public function addReserva($libro,$usu){
        $res = "err";
        $result = array();
        $conn = $this->conectarBD();  
        $sql = "INSERT INTO reservas (res_ID,usu_ID,lib_ID,fechaIni,fechaFin,realizada) 
                VALUES((select max(res_ID) + 1 from reservas res),".$usu.",".$libro.",sysdate(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),0);;";
            if ($resultado = $conn->query($sql)) {
                $sql = "select cop_id from copias where lib_id = ".$libro." and est_id = 2 limit 1;";
                if ($resultado = $conn->query($sql)) {
                    if($resultado->num_rows>0){
                    $result = $resultado->fetch_all(MYSQLI_NUM);    
                    $res = $result[0][0];
                    $sql = "update copias set est_id = 6 where cop_id= ".$res.";";
                    if ($resultado = $conn->query($sql)) {
                        $res = "ok";
                        }
                    } 
                }
                
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function libroAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select lib_id as id, nombre as value from libros where nombre like '" . $dato . "%' and eliminado = 0 order by nombre desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function getLibroRes($libro){
        $sql = "select lib_id from libros where 1 = 1 ";
        if ($libro->getNombre()!= "") $sql = $sql . "and nombre like '" . $libro->getNombre() . "%' ";
        if ($libro->getAut_ID()!= 0) $sql = $sql . "and aut_id = " . $libro->getAut_ID() . " ";
       // if ($libro->getAut_ID()!= 0) $sql = $sql . "and aut_id = " . $libro->getAut_ID() . " ";
       // if ($libro->getAut_ID()!= 0) $sql = $sql . "and aut_id = " . $libro->getAut_ID() . " ";
        $conn = $this->conectarBD();
        $res = array();
        $sql = $sql  . " and eliminado = 0 ";
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $result = $resultado->fetch_all(MYSQLI_NUM);    
                $id = $result[0][0];
                $res = $this->getLibro($id);
            }
            else {
                $res[0] = "err";
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function getCopiasDisponibles($id){
        $sql = "select count(cop_id)  
                from copias c 
                inner join libros l on c.lib_id = l.lib_id  
                where l.eliminado = 0 
                and c. est_id = 2 
                and c.lib_id = ".$id. ";";
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
