<?php

final class ModeloPrincipal extends Modelo {

    public function iniciarSesion($Usu, $clave) {
        $conn = $this->conectarBD();
       
        $consulta = "SELECT * from usuarios u 
                    inner join perfiles p on u.perf_ID = p.perf_ID 
                    where u.login='" . $Usu . "' and u.clave='".$clave."' ";

        if ($resultado = $conn->query($consulta)) {
            if($resultado->num_rows>0){
                while ($fila = $resultado->fetch_row()) {
                    $_SESSION['idUsuario'] =$fila[0]; 
                    $_SESSION['idPerfil'] =$fila[1]; 
                    $_SESSION['usuNombre'] =$fila[2];
                    $_SESSION['usuLogin'] =$fila[3];
                    $_SESSION['perfNombre'] =$fila[9];
                    $_SESSION['datosUsu'] = $_SESSION['usuNombre'] . " (".$_SESSION['usuLogin'] . ")" . " <br> " . $_SESSION['perfNombre'];
                   
                }
                $resultado->close();
                $msg = "ok";
                } 
            else {  
                $msg = "Usuario o clave incorrectos";
            }
        }
       $this->desconectarBD($conn);
       return $msg;
        
    }

    public function getFecha() {
       
       $fecha = date("d") . " - " . date("m") . " - " . date("Y");
        return $fecha;
    }

    public function getFuncionalidades($idPerfil){
        $sql = "select f.func_ID, f.descripcion, f.comentario from perf_funcionalidad pf
                inner join funcionalidades f ON pf.func_ID = f.func_ID
                WHERE pf.per_ID =$idPerfil
                 AND pf.eliminado =0;";
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
}

?>
