<?php
session_start();
if(!isset($_SESSION['nome']))
{
    header("Location: "."login.php");
}
if($_SESSION['nivel']>0){
    die("nao autorizado");
    session_destroy();
    exit;
}
$_SESSION['titulo']="home";
include "../templates/superior.php";
include __DIR__."/bodyHome.php";
include "../templates/inferior.php";
