<?php

require_once 'app/inc/Modelo.php';

final class ModeloPrincipal extends Modelo {

    protected $server = "127.0.0.1";
    protected $bd = "biblio";
    protected $usr ="root";
    protected $pass = "";

    public function conectarBD(){
        $conn = new mysqli($this->server, $this->usr, $this->pass, $this->bd);
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
        if (!$conn->set_charset("utf8")) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
            exit();
        }
        return $conn;
    }

    public function desconectarBD($mysqli){
        $mysqli->close();
    }



    public function getParametro($hash, $parametro) {
        $client = $this->conectarJBoss();
        $param = array(
            'hash' => $hash,
            'parametro' => $parametro,
        );
        $result = $client->call('getParametro', $param, '', '', false, true);
        if (!$result) {
            $result = array();
            $result['return']['estado'] = -1;
            $result['return']['txtmsg'] = "<span style='color:black;'>No se puede ejecutar getParametro en JBOSS</span>";
            return $result;
            //   die(); //completar
        }
        return $result['return'];
    }

    public function getQuery() {
        
        $conn = $this->conectarBD();
       
        $consulta = "SELECT * from libros";

        if ($resultado = $conn->query($consulta)) {
            while ($fila = $resultado->fetch_row()) {
                var_dump($fila);
            }

            $resultado->close();
        }
        $this->desconectarBD($conn);
    }

    public function iniciarSesion($Usu, $clave) {
      //  session_start();
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
       //session_write_close();
       return $msg;
        
    }
/*
    public function validarSesion($hash) {

        $client = $this->conectarJBoss();
        $param = array('hash' => $hash);
        $result = $client->call('isSesionActiva', $param, '', '', false, true);
        if ($result['return']['estado'] == "-1") {
            return $result['return']['txtmsg'];
        } else {
            return "ok";
        }
    }

    public function cerrarSesion($idUsuario, $hash) {

        $client = $this->conectarJBoss();
        $param = array('idUsuario' => $idUsuario,
            'hash' => $hash
        );
        $result = $client->call('logOut', $param, '', '', false, true);
        if (!$result) {
            echo "<span style='color:white;'>No se puede ejecutar LogOut en JBOSS</span>";
            // die(); //completar
        }
        return $result;
    }
*/
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
/*
    public function getPaises(){
        $sql = "select iso, nombre from paises;";
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
        $sql = "select aut_ID, nombreApe, nacionalidad from autores;";
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
*/
}

?>
