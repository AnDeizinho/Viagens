<?php 
namespace Viagens\adm;
use Exception;
use \Viagens\model\Crud;
include "../../model/crud.php";
$mensagem="";
$atualizar=[];
if(isset($_POST['cnpj'])){
  try{
    $cnpj = $_POST['cnpj'];
    $rasao = $_POST['razao'];
    $fantasia = $_POST['fantasia'];
    $crud = new Crud;
    $saida = $crud->execute("call salva_fornecedores(:cnpj,:rasao,:fantasia);",
                            ["cnpj"=>$cnpj,"rasao"=>$rasao,"fantasia"=>$fantasia]);
    
    foreach($saida as $i){
      $mensagem = $mensagem.$i;
    }
    if(empty($mensagem)){
      $mensagem = '<p style="color:blue;">cadastrado com sucesso!</p>';
    }else{
      $mensagem = '<p style="color:red";>'.$mensagem.'</p>';
    }
  }
  catch(Exception $e)
  {
      echo($e);
  }
}else if(isset($_GET['cnpj'])){
  $crud = new Crud();
  $result = $crud->select("select * from fornecedores where cnpj=? limit 1",[$_GET['cnpj']]);
  if(count($result) >0){
    $atualizar['cnpj']=$result[0]['cnpj'];
    $atualizar['rasao']=$result[0]['rasao'];
    $atualizar['fantasia']=$result[0]['fantasia'];
  }else{
    $mensagem="<p>erro ao carregar</P>";
  }
}
?>


<form class="container" action="/adm/fornecedores/" method="POST">
    <style>
        form{
            margin-top:25px;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">CNPJ</label>
      <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00" data-mask="00.000.000/0000-00" require
      value="<?php echo($atualizar['cnpj']);?>"
          <?php 
            if(isset($atualizar['cnpj'])){
              echo("readonly");
            }else{
              echo("");
            }
          ?>
    >
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Razão Social</label>
      <input type="text" class="form-control " id="inputPassword4" name="razao" require value="<?php echo( $atualizar['rasao']);?>">
    </div>
  </div>
  

  <div class="form-row">
    <div class="form-group">
      <label for="inputEstado">Fantasia</label>
      <input type="text" class="form-control " id="inputCity" name="fantasia" require value="<?php echo($atualizar['fantasia']);?>">
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Salvar</button>
        <?php 
          echo($mensagem);
        ?>
</form>
<table class="table table-striped container">
  <thead class="thead">
    <tr>
      <th scope="col">CNPJ</th>
      <th scope="col">Rasão Social</th>
      <th scope="col">Fantasia</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 
        $crud = new Crud;
        $lista = $crud->select("select * from fornecedores");
        foreach($lista as $i){
          echo("<tr>");
          echo("<td>".$i['cnpj']."</td>");
          echo("<td>".$i['rasao']."</td>");
          echo("<td>".$i['fantasia']."</td>");
        
      
      
      echo("<td>");
          echo('<a class="btn btn-primary" style="color:white;" href="/adm/fornecedores/?cnpj='.$i['cnpj'].'">Alterar</a> ');
          echo('<a class="btn btn-danger" style="color:white;" href="/adm/fornecedores/del/?cnpj='.$i['cnpj'].'">Deletar</a>');
      echo("</td");
      echo("</tr>");
        }
      ?>
  </tbody>
</table>

