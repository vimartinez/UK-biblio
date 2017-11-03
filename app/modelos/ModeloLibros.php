<?php

final class ModeloLibros extends Modelo {

    public function getLibros(){
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
        $sql = "insert into libros (aut_ID,isbn,nombre,genero,subgenero,editorial,resena,copias,eliminado) values(".
            $libro->getAut_ID().",'".
            $libro->getIsbn()."','".
            $libro->getNombre()."','".
            $libro->getGenero()."','".
            $libro->getSubgenero()."','".
            $libro->getEditorial()."','".
            $libro->getResena()."','".
            $copias."',0);";
            if ($resultado = $conn->query($sql)) {
                $lib_id = $conn->insert_id;
                for ($i=0;$i<$copias;$i++){
                    $copia = $i+1;
                    $sql = "insert into copias (lib_ID,est_ID,copia,calle,pasillo,estante)
                        values(".$lib_id.",1,". $copia . ", null, null, null );";  
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
        $sql = "select cop_id from copias where lib_id = ".$libro." and est_id = 2 limit 1;";
        $conn = $this->conectarBD();
        $conn->begin_transaction();
        //if ($resultado = $conn->query($sql)) {
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $result = $resultado->fetch_all(MYSQLI_NUM);    
                $copia = $result[0][0];
                $sql = "update copias set est_id = 6 where cop_id= ".$copia.";";
                if ($resultado = $conn->query($sql)) {
                    $sql = "INSERT INTO reservas (usu_ID,lib_ID,cop_id,fechaIni,fechaFin,realizada) 
                        VALUES(".$usu.",".$libro.",".$copia.",sysdate(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),0);";
                    if ($resultado = $conn->query($sql)) {
                        $res = "ok";
                    }
                }
            } 
        }
        //} 
        if ($res == "ok"){
            $conn->commit();
        }
        else {
            $conn->rollback();
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
     public function editorialAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select distinct 0 as id, editorial as value from libros where editorial like '" . $dato . "%' and eliminado = 0 order by editorial desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function generoAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select distinct 0 as id, genero as value from libros where genero like '" . $dato . "%' and eliminado = 0 order by genero desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function subGeneroAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select distinct 0 as id, subgenero as value from libros where subgenero like '" . $dato . "%' and eliminado = 0 order by subgenero desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function isbnAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select distinct 0 as id, isbn as value from libros where isbn like '" . $dato . "%' and eliminado = 0 order by isbn desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function addPrestamoRes($resID){
        $res = "err";
        $result = array();  
        $sql = "select usu_id, lib_id, cop_id from reservas where res_id= ".$resID." ;";
        $conn = $this->conectarBD();
        $conn->begin_transaction();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $result = $resultado->fetch_all(MYSQLI_NUM);    
                $usu_id = $result[0][0];
                $lib_id = $result[0][1];
                $cop_id = $result[0][2];
                $sql = "update copias set est_id = 3 where cop_id= ".$cop_id.";";
                if ($resultado = $conn->query($sql)) {
                    $sql = "INSERT INTO prestamos (usu_ID, res_ID, lib_ID, cop_ID, fechaIni, fechaFin) 
                        VALUES(".$usu_id.",".$resID.",".$lib_id.",".$cop_id.",sysdate(),DATE_ADD(CURDATE(), INTERVAL ".DURACION_PRESTAMO." DAY));";
                    if ($resultado = $conn->query($sql)) {
                        $sql = "update reservas set realizada = 1 where res_id= ".$resID.";";
                        if ($resultado = $conn->query($sql)) {
                            $res = "ok";
                        }    
                    }
                }
            } 
        } 
        if ($res == "ok"){
            $conn->commit();
        }
        else {
            $conn->rollback();
        }
       $this->desconectarBD($conn);
       return $res;
    }
        public function addPrestamoSinRes($usu_id, $lib_id){        
        $res = "err";
        $result = array();  
        $sql = "select cop_id from copias where lib_id = ".$lib_id." and est_id = 2 limit 1;";
        $conn = $this->conectarBD();
        $conn->begin_transaction();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $result = $resultado->fetch_all(MYSQLI_NUM);    
                $copia = $result[0][0];
                $sql = "update copias set est_id = 3 where cop_id= ".$copia.";";
                if ($resultado = $conn->query($sql)) {
                    $sql = "INSERT INTO prestamos (usu_ID, res_ID, lib_ID, cop_ID, fechaIni, fechaFin) 
                        VALUES(".$usu_id.",null,".$lib_id.",".$copia.",sysdate(),DATE_ADD(CURDATE(), INTERVAL ".DURACION_PRESTAMO." DAY));";
                    if ($resultado = $conn->query($sql)) {
                        $res = "ok";    
                    }
                }
            } 
        } 
        if ($res == "ok"){
            $conn->commit();
        }
        else {
            $conn->rollback();
        }
       $this->desconectarBD($conn);
       return $res;
    }
    public function getPrestamosActivos(){
        $sql = 'select p.pres_ID , p.usu_ID, p.lib_ID, p.cop_id, DATE_FORMAT(p.fechaIni, "%e/%m/%Y") as Desde, DATE_FORMAT(p.fechaFin, "%e/%m/%Y")as Hasta, l.aut_ID, l.nombre, a.nombreApe, u.nombreApe, c.copia
                from prestamos p
                inner join libros l on p.lib_id = l.lib_id 
                inner join usuarios u on p.usu_id = u.usu_id
                inner join autores a on l.aut_id = a.aut_id 
                inner join copias c on p.cop_id = c.cop_id 
                where devuelto = 0;';
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
    public function devolucion($lib_id,$copia){
        $res = "err";
        $sql = "select cop_id from copias where lib_id = ".$lib_id." and copia = ".$copia.";";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $result = $resultado->fetch_all(MYSQLI_NUM);    
                $cop_id = $result[0][0];
                $sql = "update prestamos set devuelto = 1 where lib_id = ".$lib_id." and cop_ID = ".$cop_id.";";
                $conn->query($sql);
                if ($conn->affected_rows > 0) {
                    $res = "ok";
                }
            }    
        } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function getReservasActivas(){
        $sql = 'select r.res_ID, r.usu_ID, r.lib_ID, r.cop_id, DATE_FORMAT(r.fechaIni, "%e/%m/%Y") as Desde, DATE_FORMAT(r.fechaFin, "%e/%m/%Y") as Hasta, l.lib_ID, l.aut_ID, l.nombre, u.nombreApe, a.nombreApe, c.copia, c.calle, c.pasillo, c.estante 
                from reservas r
                inner join libros l on r.lib_id = l.lib_id
                inner join usuarios u on r.usu_id = u.usu_id
                inner join autores a on l.aut_id = a.aut_id
                inner join copias c on r.cop_id = c.cop_id
                where realizada = 0;';
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