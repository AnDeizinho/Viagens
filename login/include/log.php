<?php
namespace Viagens\adm;
use \Viagens\model\Login;
include "../model/crud.php";
include "../model/login.php";

session_start();
if(isset($_SESSION['nome'])){
    header("Location:/");
    exit;
}
$erros = array();
if(isset($_POST)){
    if(empty($_POST['email']) or empty($_POST['senha'])){
        $erros[]='<p>Preencha todos os campos</p>';
    }else{
        $login = new Login();
        $result = $login->fazerlogin($_POST['email'], $_POST['senha']);
        if(count($result) == 0){
            $erros[]='<p>Usuario nao encontrado</p>';
        }else{
            if($result[0]['nivel'] > 0){
                $_SESSION['nome'] = $result[0]['nome'];
                $_SESSION['email'] = $result[0]['email'];
                $_SESSION['senha'] = $result[0]['senha'];
                $_SESSION['nivel'] = $result[0]['nivel'];
                $_SESSION['fk_cliente'] = $result[0]['fk_cliente'];
                header("Location:/");
                exit;
            }else{
                $erros[]='<p>Usuario não possui nível de acesso</p>';
            }
        }
    }
}?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - Cliente</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

