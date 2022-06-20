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
$_SESSION['titulo']="Cadastro - Produto";
include "../templates/superior.php";
include __DIR__."/include/bodyProdutos.php";
include "../templates/inferior.php";
