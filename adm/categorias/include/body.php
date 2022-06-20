<?php 
namespace Viagens\adm;
use Exception;
use \Viagens\model\Crud;
include "../../model/crud.php";
$mensagem="";
$atualizar=[];
$atualizar['id']=0;
if(isset($_POST['nome'])){
  try{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descr = $_POST['descricao'];
    $crud = new Crud;
    $saida = $crud->execute("call salva_categorias(:id, :nome,:descr);",
                            ["id"=>$id,"nome"=>$nome,"descr"=>$descr]);
    
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
}else if(isset($_GET['id'])){
  $crud = new Crud();
  $result = $crud->select("select * from categorias where id=? limit 1",[$_GET['id']]);
  if(count($result) >0){
    $atualizar['id']=$result[0]['id'];
    $atualizar['nome']=$result[0]['nome'];
    $atualizar['descricao']=$result[0]['descricao'];
  }else{
    $mensagem="<p>erro ao carregar</P>";
  }
}
?>


<form class="container" action="/adm/categorias/" method="POST">
    <style>
        form{
            margin-top:25px;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">id</label>
      <input type="number" class="form-control" name="id" require
          value="<?php echo($atualizar['id']);?>" readonly>
    </div>
    <div class="form-group col-md-8">
      <label for="inputPassword4">Nome</label>
      <input type="text" class="form-control " name="nome" require value="<?php echo( $atualizar['nome']);?>" maxlength="100">
    </div>
    
  </div>

  <div class="form-group">
      <label for="inputEstado">Descrição</label>
      <textarea type="text" class="form-control"  name="descricao" maxlength="200" require >
        <?php echo($atualizar['descricao']);?>
      </textarea>
    </div>
  

 
    
  
  <button type="submit" class="btn btn-primary">Salvar</button>
        <?php 
          echo($mensagem);
        ?>
</form>
<table class="table table-striped container">
  <thead class="thead">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Descrião</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 
        $crud = new Crud;
        $lista = $crud->select("select * from categorias");
        foreach($lista as $i){
          echo("<tr>");
          echo("<td>".$i['nome']."</td>");
          echo("<td>".$i['descricao']."</td>");
        
      
      
      echo("<td>");
          echo('<a class="btn btn-primary" style="color:white;" href="/adm/categorias/?id='.$i['id'].'">Alterar</a> ');
          echo('<a class="btn btn-danger" style="color:white;" href="/adm/categorias/del/?id='.$i['id'].'">Deletar</a>');
      echo("</td");
      echo("</tr>");
        }
      ?>
  </tbody>
</table>

