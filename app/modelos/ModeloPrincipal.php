<?php

require_once 'app/inc/Modelo.php';

final class ModeloPrincipal extends Modelo {

    public function getParametroSI() {
        $client = $this->conectarJBoss();
        $param = array();
        $result = $client->call('getParametroSI', $param, '', '', false, true);
        if (!$result) {
            echo "<span style='color:white;'>No se puede ejecutar getparametro en JBOSS</span>";
            //   die(); //completar
        }
        $strRes = $result['return']['valor'];
        return $strRes;
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
