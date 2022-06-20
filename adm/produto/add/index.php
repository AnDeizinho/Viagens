<?php
session_start();
if(!isset($_SESSION['nome']))
{
    header("Location: "."../home");
}
if($_SESSION['nivel']>0){
    die("nao autorizado");
    session_destroy();
    exit;
}
$_SESSION['titulo']="Produtos";
include "../../templates/superior.php";
include "../include/bodyaddprod.php";
include "../../templates/inferior.php";