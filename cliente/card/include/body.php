<?php 
  use \Viagens\model\Crud;
  $crud = new Crud();
  $isget = false;
  $dadosget=[];
  
  if(isset($_GET['cpf']))
  {
    $isget=true;
    $ra= $crud->select("select nome, sobrenome, cpf from clientes where cpf=? limit 1;", [ $_GET['cpf']]);
    $dadosget['cpf']=$ra[0]['cpf'];
    $dadosget['nome']=$ra[0]['nome'].' '.$ra[0]['sobrenome'];
    $ra= $crud->select("select numero, ccv, venc from cards where cpf=? limit 1",[$dadosget['cpf']]);
    
    foreach($ra as $r){
      $dadosget['numero']=$r['numero'];
      $dadosget['ccv']=$r['ccv'];
      $dadosget['venc']=$r['venc'];
    }
  }else{
    header("Location:/");
  }
?>

<H1 class="text-center">Pagamento</H1>
<form class="container" action="./cadd.php" method="POST">

    <!-- DADOS DO CLIENTE-->
    <fieldset>
        <legend>Cartão de Crédito</legend>
       <div class="form-row">
       <div class="form-group col-md-6">
            <label for="nome">Nome: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['nome'].'"');
        }
      ?> name="nome" readonly="true">
        </div>
        <div class="form-group col-md-6">
            <label for="nome">CPF: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['cpf'].'"');
        }
      ?> name="cpf" readonly>
        </div>
       </div> 
        
        <div class="form-row">
        <div class="form-group col-md-12">
            <label for="sobrenome">Número: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['numero'].'"');
        }
      ?> name="numero" data-mask="0000-0000-0000-0000">
        </div>

        </div>
        
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="rg">Data Vencimento: </label>
            <input class="form-control" type="text" <?php 
        if($isget==true){
        echo('value="'.$dadosget['venc'].'"');
        }
      ?> name="venc" data-mask="00/0000" placeholder="00/0000">
        </div>
        </div>
        

        <div class="form-row">
        <div class="form-group col-md-3">
            <label>CCV:</label>

            <input class="form-control" type="number" <?php 
        if($isget==true){
        echo('value="'.$dadosget['ccv'].'"');
        }
      ?> 
      name="ccv" required>

        </div>   
      </div>
        

    </fieldset>

    <button class="btn btn-primary" type="submit">Salvar</button>
</form>