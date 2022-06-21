<?php
setlocale(LC_MONETARY, 'pt_BR');
session_start();
if(isset($_SESSION['nome'])){
    $_SESSION['titulo'] = 'Pacotes';
    if($_SESSION['nivel']==0){
        die("nivel de acesso negado");
        header("Location:/adm/sair.php");
    }
}
include "../model/crud.php";
use \Viagens\model\Crud;
$crud = new Crud();
$query = "select a.preco, a.id, a.nome, a.destino, a.descricao, b.fantasia , c.nome as categoria from produtos as a
inner join fornecedores as b on a.pk_fornecedor = b.cnpj 
inner join categorias as c on a.pk_categoria = c.id";
$destinos;
if(isset($_POST['tipo'])){
    if($_POST['tipo'] == 1){
      $destinos = $crud->select($query." where b.fantasia like ?", ['%'.$_POST['psq'].'%']);
    }else if($_POST['tipo'] == 2){
      $destinos = $crud->select($query." where c.nome like ?", ['%'.$_POST['psq'].'%']);
    }else{
        $destinos = $crud->select($query);
    }
}else{
        
$destinos = $crud->select($query);
}


function gera_corpo($destinos){

  $esq = false;
  foreach($destinos as $i){
      echo('<div class="row featurette">
        <div class="col-md-7 align-self-center');
        if($esq==false){  
          echo('" >');
          $esq=true;
        }else
        {
          $esq=false;
          echo(' order-md-2">');
        }
        echo('<h2 class="featurette-heading">'.$i['nome'].'<span class="text-muted">. Em '.$i['destino'].'</span></h2>
          
          <p class="lead">'.$i['descricao'].'</p>
          <p class="lead text-primary">Fornecedor :'.$i['fantasia'].' <span class="text-muted">Categoria: '.$i['categoria'].'</p>
          <a class="btn btn-success" href="/pacote/?id='.$i['id'].'">Comprar</a>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" style="width: 500px; height: 500px;" src="/bootstrap/img/'.$i['destino'].'/1" data-holder-rendered="true">
        </div>
      </div>

      <hr class="featurette-divider">');
  }
}
include __DIR__."/include/superior.php";
include __DIR__."/include/body.php";
include "../templates/inferior.php";