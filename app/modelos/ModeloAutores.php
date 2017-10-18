<?php

require_once 'app/inc/Modelo.php';
require_once 'ModeloPrincipal.php';

final class ModeloAutores extends Modelo {

    public function getPaises(){
        $sql = "select iso, nombre from paises;";
        $res = array();
        $mp = new ModeloPrincipal("");
        $conn = $mp->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "No se encontraron resultados";
            }
        }
       $mp->desconectarBD($conn);
       return $res;
    }

    public function getAutores(){
        $sql = "select aut_ID, nombreApe, nacionalidad from autores;";
        $res = array();
        $mp = new ModeloPrincipal("");
        $conn = $mp->conectarBD();
        if ($resultado = $conn->query($sql)) {
            if($resultado->num_rows>0){
                $res = $resultado->fetch_all(MYSQLI_NUM);
                $resultado->close();
                } 
            else {  
                $res[] = "No se encontraron resultados";
            }
        }
       $mp->desconectarBD($conn);
       return $res;
    }

}

?>