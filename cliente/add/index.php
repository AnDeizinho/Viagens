<?php 
 
  use \Viagens\model\Crud;
  include "../../model/crud.php";
  $crud = new Crud();
  if(isset($_POST['cpf']))
  {
    $dados = [
      "nome" => $_POST['nome'],
      "sobrenome" => $_POST['sobrenome'],
      "cpf" => $_POST['cpf'],
      "fone" => $_POST['fone']
    ];
    $dados2 =[
      "nome" => $_POST['nome'],
      "cpf" => $_POST['cpf'],
      "email" => $_POST['email'],
      "senha" => $_POST['senha']
    ];
    
    $res = $crud->execute("insert into clientes (cpf,nome,sobrenome,celular) values (:cpf,:nome,:sobrenome,:fone);",$dados);
  
    foreach($res as $i){
      $mensagem.$i;
      
    }
    $res = $crud->execute("insert into usuarios (nome,email,senha,nivel,fk_cliente) values (:nome,:email,MD5(:senha),1,:cpf);",$dados2);
  
    foreach($res as $i){
      $mensagem.$i;
    }
    header("Location:/login");

  }

  include "../../templates/superior.php"
  
?>

<H1 class="text-center">Cadastro</H1>
<form class="container" method="POST">

<!-- DADOS DO CLIENTE-->
<fieldset class="form-row">
  <legend>Dados pessoais</legend>
    <div class="form-group col-md-3">
      <label for="nome">Nome: </label>
      <input class="form-control" type="text" name="nome">
    </div>
    
   <div class="form-group col-md-3">
      <label for="sobrenome">Sobrenome: </label>
      <input class="form-control" type="text" name="sobrenome"> 
   </div>
   
   <div class="form-group col-md-3">
     <label for="rg">CPF: </label>
    <input class="form-control" type="text" name="cpf" data-mask="000.000.000-00" placeholder="000.000.000-00">
   </div>
    
   
   <div class="form-group col-md-3">
   <label>Celular:</label>
   
   <input class="form-control" type="text"  name="fone" data-mask="(00) 00000-0000" required placeholder="(00) 00000-0000">
 
   </div>
 
</fieldset>





<!-- LOGIN -->
<fieldset class="form-row">
 <legend>Login</legend>
    <div class="form-group col-md-6">
      <label for="email">E-mail: </label>
      <input type="email" require class="form-control" name="email">
    </div>
    <div class="form-group col-md-6"> 
      <label for="pass">Senha: </label>
      <input type="password" require class="form-control" name="senha">
    </div>
   
</fieldset>
<button class="btn btn-primary" type="submit">Salvar</button>
<button type="reset" class="btn btn-warning">Limpar</button>
</form>

<?php 
  include "../../templates/inferior.php"
?>
