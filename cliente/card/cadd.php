<?php 

include "../../model/crud.php";
use \Viagens\model\Crud;
$crud = new Crud();

if(isset($_POST['nome'])) 
{
      
      $dados = [
        "nome" => $_POST['nome'],
        "numero" => $_POST['numero'],
        "venc" => $_POST['venc'],
        "ccv" => $_POST['ccv'],
        "cpf" => $_POST['cpf']
      ];
      
      $res = $crud->select("select cpf from cards where cpf = ?",[$dados['cpf']]);
      if(count($res) == 0){
          $res = $crud->execute("insert into cards (numero, venc,ccv,cpf) value (?,?,?,?);",[$dados['numero'], $dados['venc'], $dados['ccv'], $dados['cpf']]);
        
      }else{
        $res = $crud->execute("update cards set numero=? ,venc =?, ccv=? where cpf = ?;",[$dados['numero'],$dados['venc'],$dados['ccv'],$dados['cpf']]);
      }
      header("Location:/cliente/card/?cpf=".$dados['cpf']);
}
else
{
  header("Location:/");

}