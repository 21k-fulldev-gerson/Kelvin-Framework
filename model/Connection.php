<?php


class Conexao{
    private $servidor;
    private $banco;
    private $usuario;
    private $senha;

//Entre as "" coloque corretamente as informações de Servidor, NameBD, User e senha

    function __construct(){
        $this->servidor = "localhost";
        $this->banco = "";
        $this->usuario = "root";
        $this->senha = "";
    }

    //function conectar

    public function conectar(){
        try{
            $con = new PDO("mysql:host={$this->servidor};dbname={$this->banco};charset=utf8;",$this->usuario,$this->senha);
            return $con;
        }catch(PDOException $msg){
            echo"Não foi possível conectar ao banco de dados. {$msg->getMessage()}";
        }
    }
}
