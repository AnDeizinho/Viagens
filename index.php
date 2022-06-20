<?php
session_start();
if(isset($_SESSION['nome'])){
    $_SESSION['titulo'] = 'home';
    if($_SESSION['nivel']==0){
        die("nivel de acesso negado");
        header("Location:/adm/sair.php");
    }
}
include __DIR__."/model/crud.php";
include __DIR__."/templates/superior.php";
include __DIR__."/home/body.php";
include __DIR__."/templates/inferior.php";