<!-- ESTE É APENAS UM CODIGO COM CLASSES E FUNCÕES PRÉ PRONTAS, É NECESSARIO ALTERAR CONFORME A NECESSIDADE DO SEU PROJETO

<?php
require_once "Conexao.php";
session_start();

class Movimentacoes{
	public $ID;
	public $ID_USUARIO;
	public $VALOR;
	public $TIPO;
	public $ID_CATEGORIA;
	public $DATA;

//INSERINDO INFORMAÇÃO DO BANCO
	public function ExemploInsert(){
		try{
			if ($_SESSION["id_usu"]) {
                //valores a serem inseridos no banco
				$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
				$this->VALOR = $_POST["valorgasto"];
				$this->TIPO = 'D';
				$this->ID_CATEGORIA = $_POST["categoriagasto"];
				$this->DATA = $_POST["datagasto"];
               //solicitando conexao com o banco
				$bd = new Conexao();
				$con = $bd->conectar();
				$sql = $con->prepare("insert into movimentacoes(id,id_usuario,valor,tipo,id_categoria,data) values(null,?,?,?,?,?);");
				$sql->execute(array(
					$this->ID_USUARIO,
					$this->VALOR,
					$this->TIPO,
					$this->ID_CATEGORIA,
					$this->DATA
				));
				if ($sql->rowCount() > 0) {
					header("location: dashboard.php");
				}
				}else{
					header("location: index.php");
				}
			}catch(PDOException $msg){
			echo "Não foi possível adicionar a movimentação. {$msg->getMessage()}";
		}
	}


//PUXANDO INFORMAÇÃO DO BANCO
    public function ExemploSelect(){
    	try{
    		$this->ID_USUARIO = $_SESSION["id_usu"][0][0];
    		$data = $this->DATA = "";

	  		$bd = new Conexao();
    		$con = $bd->conectar();
   			$sql = $con->prepare("select data from movimentacoes where id_usuario = ?;");
    		$sql->execute(array($this->ID_USUARIO));

    		if ($sql->rowCount() > 0) {
    			return $result = $sql->fetchAll();
    		}
    	}catch(PDOException $msg){
    		echo "Não foi possível mostrar a data da movimentação. {$msg->getMessage()}";
    	}
    }
}

//EXCLUINDO INFORMAÇÃO DO BANCO
public function excluirMov($id){
    try{
        if (isset($id)) {
            $this->ID = $id;

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("delete from movimentacoes where id_usuario = ?");
            $sql->execute(array($this->ID));
            if ($sql->rowCount() > 0) {
                header("location: index.php");
            }
        }else{
            header("location: dashboard.php");
        }
    }catch(PDOException $msg){
        echo "Não foi possível excluir o usuário. {$msg->getMessage()}";
    }

    //EDITANDO INFORMAÇÃO DO BANCO

    public function alterarSaldo(){
		try{
			$this->ID = $_SESSION["id_usu"][0][0];
			$this->SALDO = $_SESSION["mandaprobanco"];

			$bd = new Conexao();
	    	$con = $bd->conectar();
	    	$sql = $con->prepare("update usuarios set saldo = ? where id = ?;");
		    $sql->execute(array(
			  	$this->SALDO,
				$this->ID
	 		));

		    if ($sql->rowCount() > 0) {
		    	header("location: entradas.php");
		   	}else{
		   		header("location: dashboard.php");
		   	}
		}catch(PDOException $msg){
			echo "Não foi possível alterar o saldo. {$msg->getMessage()}";
		}
	}
