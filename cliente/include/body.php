<?php 

  use \Viagens\model\Crud;
  $crud = new Crud();
  $isget = false;
  if(isset($_POST['cpf']))
    {
      $isget=false;
      $dados = [
        "nome" => $_POST['nome'],
        "sobrenome" => $_POST['sobrenome'],
        "cpf" => $_POST['cpf'],
        "fone" => $_POST['fone']
      ];
      
      $res = $crud->execute("update clientes set nome = :nome ,sobrenome = :sobrenome ,celular = :fone where cpf = :cpf;",$dados);
      
    }
  $dadosget=[];
  if(isset($_GET['cpf'])){
    $isget=true;
    $r = $crud->select("select * from clientes where cpf = :cpf limit 1", ["cpf"=> $_GET['cpf']]);
    $dadosget['cpf']=$r[0]['cpf'];
    $dadosget['nome']=$r[0]['nome'];
    $dadosget['fone']=$r[0]['celular'];
    $dadosget['sobrenome']=$r[0]['sobrenome'];
  }else{
    
      header("Location:/login");
    
}
?>

<H1 class="text-center">Cadastro</H1>
<form class="container" method="POST">

    <!-- DADOS DO CLIENTE-->
    <fieldset class="form-row">
        <legend>Dados pessoais</legend>
        <div class="form-group col-md-3">
            <label for="nome">Nome: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['nome'].'"');
        }
      ?> name="nome">
        </div>

        <div class="form-group col-md-3">
            <label for="sobrenome">Sobrenome: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['sobrenome'].'"');
        }
      ?> name="sobrenome">
        </div>

        <div class="form-group col-md-3">
            <label for="rg">CPF: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['cpf'].'" readonly');
        }
      ?> name="cpf" data-mask="000.000.000-00" placeholder="000.000.000-00">
        </div>


        <div class="form-group col-md-3">
            <label>Celular:</label>

            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['fone'].'"');
        }
      ?> 
      name="fone" data-mask="(00) 00000-0000" required placeholder="(00) 00000-0000">

        </div>

    </fieldset>

    <button class="btn btn-primary" type="submit">Salvar</button>
</form>