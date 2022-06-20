<?php

session_start();
if(!isset($_SESSION['nome']))
{
    header("Location: "."../home/");
}
if($_SESSION['nivel']>0){
    die("nao autorizado");
    session_destroy();
    exit;
}
$_SESSION['titulo']="Categorias";
$mensagem = "";

include "../templates/superior.php";
include __DIR__."/include/body.php";
include "../templates/inferior.php";
