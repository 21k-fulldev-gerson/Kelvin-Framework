<?php
//Requerindo a function conectar com o BD

require_once "Conexao.php";

//criando a classe Usuarios

class Usuarios{
	public $ID;
	public $USUARIO;
	public $SENHA;
	public $EMAIL;
	
//function inserir no banco

	public function inserir(){
		try{
			if (isset($_POST["email"]) && isset($_POST["senha"])) {
					$this->USUARIO = $_POST["usuario"];
					$this->EMAIL = $_POST["email"];
					$this->SENHA = $_POST["senha"];
					$this->SALDO = 0;
					$bd = new Conexao();
					$con = $bd->conectar();
					$sql = $con->prepare("insert into namedb(id,usuario,senha,email) values(null,?,?,?);");
					$sql->execute(array(
						$this->USUARIO,
						$this->SENHA,
						$this->EMAIL
					));
					if ($sql->rowCount() > 0) {
						header("location: index.php");
					}
				}else{
					header("location: registrar.php");
				}
			}catch(PDOException $msg){
			echo "Não foi possível criar o usuario. {$msg->getMessage()}";
		}
	}

//function validar login

	public function login(){
		try{
			if(isset($_POST["email"]) && isset($_POST["senha"])){
				session_start();
				$this->EMAIL = $_POST["email"];
				$this->SENHA = $_POST["senha"];
				$id = $_SESSION["id_usu"][0][0];

				$bd = new Conexao();
				$con = $bd->conectar();
				$sql = $con->prepare("select * from namedb where email = ? and senha = ?;");
				$sql->execute(array($this->EMAIL, $this->SENHA));

				if ($sql->rowCount() > 0) {
                    //adicione endereço da page que deseja ser direcionado 
					header("location: dashboard.php");
				}else{
                     //adicione endereço da page que deseja ser direcionado 
					header("location: index.php");
				}
			}else{
                 //adicione endereço da page que deseja ser direcionado 
				header("location: index.php");
			}
		}
		catch(PDOException $msg){
			echo "Não foi possível efetuar o login. {$msg->getMessage()}";
		}

		//function buscar id do user no banco

		public function listarID(){
			try{
				if (isset($_POST["email"])) {
					$this->EMAIL = $_POST["email"];
					$this->SENHA = $_POST["senha"];
					$this->ID = "";
	
					$bd = new Conexao();
					$con = $bd->conectar();
					$sql = $con->prepare("select ID from usuarios where email = ? and senha = ?;");
					$sql->execute(array($this->EMAIL,
						$this->SENHA));
	
					if ($sql->rowCount() > 0) {
						return $result = $sql->fetchAll();
					}
				}
			}catch(PDOException $msg){
				echo "Não foi possível listar o usuário. {$msg->getMessage()}";
			}
		}
	}