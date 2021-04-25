<?php 
header("Content-type:text/html; charset=utf8");
require_once "api/Usuarios.php";

$usuarios = new Usuarios();

if(isset($_POST["Logar"])){
    $usuarios->login();
    session_start();
$_SESSION["id_usu"] = $usuarios -> listarID();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
    <button type="action">
    </form>
</body>
</html>