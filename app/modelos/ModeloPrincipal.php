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

    public function iniciarSesion($Usu, $param1) {
        $blowfish = new blowfish(SEMILLA);
        $pass = bin2hex($blowfish->encrypt($Usu->getClave()));
        $param = array('segLogIn' => $param1,
            'username' => $Usu->getUsuario(),
            'password' => $pass);
        $client = $this->conectarJBoss();
        $result = $client->call('logIn', $param, '', '', false, true);
        if (!$result) {
            echo "<span style='color:white;'>No se puede ejecutar LogIn en JBOSS</span>";
            // die(); //completar
        }
        return $result['return'];
    }

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

    public function getFecha() {
       
       $fecha = date("d") . " - " . date("m") . " - " . date("Y");
        return $fecha;
    }

}

?>
