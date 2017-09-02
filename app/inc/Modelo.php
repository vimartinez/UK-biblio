<?php

abstract class Modelo {
    
    protected $cliente = null;
    protected $server = null;

    public function __construct($server) {
        $this->server = $server;

    }
}
?>
