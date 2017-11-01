<?php

final class ModeloSocios extends Modelo {

    public function getSocios(){
        $sql = "SELECT u.usu_ID, u.nombreApe, u.direccion, u.barrio, u.localidad, p.provincia "
                . " FROM usuarios u"
                . " left join provincias p on u.provincia = p.id "
                . "where perf_id=3 "
                . "and u.eliminado =0;";
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
    public function getProvincias(){
        $sql = "select id, provincia from provincias order by 1 ;";
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
   public function socioAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select id, localidad as value from localidades where localidad like   '" . $dato . "%'  ORDER BY localidad DESC";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function addSocio($socio){    
        $sql = "INSERT INTO usuarios (usu_ID, perf_ID, nombreApe, login, clave, fechaAlta, fechaBaja, direccion, barrio, localidad, provincia, mail, dni, eliminado) "
                . " VALUES ((select max(usu_ID) + 1 from usuarios u),'"
                                .$socio->getPerfil()."','"
                                .$socio->getNombreApe()."','"
                                .$socio->getLogin()."','"
                                .$socio->getClave()."',sysdate(),null,'"
                                .$socio->getDireccion()."','"
                                .$socio->getBarrio()."','"
                                .$socio->getLocalidad()."','"
                                .$socio->getProvincia()."','"
                                .$socio->getMail()."','"
                                .$socio->getDNI()."',0);"; 
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function delSocio($socio){
        $conn = $this->conectarBD();
        $res = "err";
        $sql = "update usuarios set eliminado = 1 where usu_id = ".$socio->getID()." ;";  
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
        }   
       $this->desconectarBD($conn);
       return $res;
    }
    public function getSocio($soc_id,$soc_nombre){      
        $sql = "SELECT u.usu_ID, u.nombreApe, u.direccion, u.barrio, u.localidad, p.provincia 
                 FROM usuarios u
                 left join provincias p on u.provincia = p.id 
                where  u.eliminado =0 ";
        if ($soc_id != "") $sql = $sql . " and u.usu_ID =".$soc_id;
        if ($soc_nombre != "") $sql = $sql . " and u.nombreApe ='".$soc_nombre."';";
        echo $sql;
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
    public function socioAutocomplete2($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select usu_id as id, nombreApe as value from usuarios where nombreApe like '" . $dato . "%' and eliminado = 0 order by nombreApe desc;";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
    public function getReservas($soc_id){      
        $sql = "select r.res_id, r.usu_id, r.cop_id, r.fechaini, r.fechafin, l.isbn, l.nombre, l.genero, l.subgenero, l.editorial
                from reservas r 
                inner join libros l on r.lib_id = l.lib_id 
                where r.usu_id = 1 
                and r.fechaFin > sysdate() 
                and r.realizada = 0;";
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
}

?>
