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
        $sql = "insert into autores values((select max(aut_ID) + 1 from autores au),'".$autor->getNombreApe()."','".$autor->getNacionalidad()."',0);";
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
    public function delAutor($autor){
        $sql = "update autores set eliminado = 1 where aut_id = ".$autor->getID()." ;";
        $res = "err";
        $conn = $this->conectarBD();
        if ($resultado = $conn->query($sql)) {
            $res = "ok";
            } 
       $this->desconectarBD($conn);
       return $res;
    }
}

?>
