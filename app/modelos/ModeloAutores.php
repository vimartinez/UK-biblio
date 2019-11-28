<?php

final class ModeloAutores extends Modelo {

    public function getAutores(){
        $sql = "select a.aut_ID, a.nombreApe, p.nombre 
                from autores a 
                left join paises p on a.nacionalidad = p.id 
                where a.eliminado =0 
                order by 2;";
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
    public function addAutor($autor){
        $sql = "insert into autores (nombreApe,nacionalidad,eliminado) values('".$autor->getNombreApe()."','".$autor->getNacionalidad()."',0);";
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function delAutor($autor){
        $conn = $this->conectarBD();
        $res = "err";
        $sql = "select * from libros where aut_id = ".$autor->getID()." and eliminado = 0;";
        if ($resultado = $conn->query($sql)) {
            if (sizeof($resultado->fetch_all(MYSQLI_NUM)) > 0){
                $res = "libro";
            } 
        else {
            $sql = "update autores set eliminado = 1 where aut_id = ".$autor->getID()." ;";  
            if ($resultado = $conn->query($sql)) {
                $res = "ok";
            } 
        }
    }
       
       $this->desconectarBD($conn);
       return $res;
    }
    public function autorAutocomplete($dato){
        $conn = $this->conectarBD();
        $res = array();
        $sql = "select id, nombre as value from paises where nombre like   '" . $dato . "%'  ORDER BY nombre DESC";
        if ($resultado = $conn->query($sql)) {
            while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $res[] = $fila;
            }
        }
        return $res;
        $this->desconectarBD($conn);
    }
}

?>
