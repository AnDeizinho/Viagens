<?php 
use \Viagens\model\Crud;
include "../../../model/crud.php";
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
if(isset($_GET['id'])){
    $crud = new Crud();
    $res = $crud->delete("delete from produtos where id=?", [$_GET['id']]);
    if(count($res) > 0)
        foreach($res as $i){
            echo("<p>".$i."</p>");
        }
    else{
        echo("<p>item deletado</p>");
    }
    header("Location: "."../");
}
else
{
    header("Location: "."../");
}