<?php
session_start();
if(isset($_SESSION['nome'])){
    $_SESSION['titulo'] = 'Cliente';
    if($_SESSION['nivel']==0){
        die("nivel de acesso negado");
        header("Location:/adm/sair.php");
    }
   

}
include "../model/crud.php";
include "../templates/superior.php";
include __DIR__."/include/body.php";
include "../templates/inferior.php";
