<?php

final class ModeloAutores extends Modelo {

    public function getPaises(){
        $sql = "select id, nombre from paises;";
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

    public function getAutores(){
        $sql = "select a.aut_ID, a.nombreApe, p.nombre from autores a left join paises p on a.nacionalidad = p.id;";
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
    public function addAutor($autor){
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
    public function delAutor($autor){
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
