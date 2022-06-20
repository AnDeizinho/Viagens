<?php 
  use \Viagens\model\Crud;
  include "../../../model/crud.php";
  $crud = new Crud();
  $fornecedores = $crud->select("select cnpj, fantasia from fornecedores");
  $categorias = $crud->select("select id, nome from categorias");
  if(isset($_POST['nome'])){
    if($_POST['promocao']=="on"){
      $_POST['is_promotion']=1;
    }else{
      $_POST['is_promotion']=0;
    }
    $produto = [
      "nome"=>$_POST['nome'],
      "hospedagem"=> $_POST['hospedagem'],
      "trasporte" => $_POST['transporte'],
      "destino" => $_POST['destino'],
      "fornecedor" => $_POST['fornecedor'],
      "qtd_pessoas" => $_POST['qtd_pessoas'],
      "periodo" => $_POST['periodo'],
      "qtd" =>$_POST['qtd'],
      "categoria" =>$_POST['categoria'],
      "preco" =>$_POST['preco'],
      "descricao" =>$_POST['descricao'],
      "is_promotion"=>(isset( $_POST['promocao']))?1:0
    ];
    $foi = $crud->execute("insert into produtos(nome,
    hospedagem ,
    trasport ,
    destino ,
    pk_fornecedor,
    pessoas ,
    dias ,
    qtd ,
    pk_categoria ,
    preco ,
    descricao ,
    is_promotion) 

    values (:nome,
    :hospedagem ,
    :trasporte ,
    :destino ,
    :fornecedor,
    :qtd_pessoas ,
    :periodo ,
    :qtd ,
    :categoria ,
    :preco ,
    :descricao ,
    :is_promotion);",$produto);
    
  }
$pacote;
  if(isset($_GET['id'])){
    $pacote = $crud->select("select a.id as id, b.cnpj, a.nome, destino, trasport,hospedagem, qtd, c.nome as categoria, is_promotion, preco, b.fantasia as fornecedor
    from produtos as a 
    inner join fornecedores as b on a.pk_fornecedor = b.cnpj 
    inner join categorias as c on a.pk_categoria = c.id; where id = ?", [$_GET['id']]);
   
  }
?>
<form class="container" method="POST">
    <style>
        form{
            margin-top:25px;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nome</label>
      <input type="text" class="form-control" id="inputEmail4" name="nome" value="<?php echo($pacote[0]['nome']);?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Hospedagem</label>
      <input type="text" class="form-control " id="inputPassword4" name="hospedagem" placeholder="hotel 5 estrelas" value="<?php echo($pacote[0]['hospedagem']);?>" >
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEstado">Transporte</label>
      <select id="inputEstado" class="form-control " name="transporte">
        <?php 
        if(isset($_GET['id'])){
        echo('<option selected value="'.$pacote[0]['transport'].'">'.$pacote[0]['trasport'].'</option>');
        }else{
          echo('<option selected value="null">Escolher...</option>');
        }?>
        <option value="Aéreo 1ª classe">Aéreo 1ª classe</option>
        <option value="Aéreo 2ª classe">Aéreo 2ª classe</option>
        <option value="Aéreo 3ª classe">Aéreo 3ª classe</option>
        <option value="Ferroviário">Ferroviário</option>
        <option value="Ônibus">Ônibus</option>
        <option value="Navio Cruzeiro">Navio Cruzeiro</option>
        <option value="Barco">Barco</option>
      </select>
    </div>
  <div class="form-group col-md-6">
    <label for="inputAddress2">Destino</label>
    <input type="text" class="form-control " id="inputAddress2" placeholder="Rio de Janeiro, Brasil" name="destino" value="<?php echo($pacote[0]['destino']); ?>">
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Fornecedor</label>
      <select id="inputEstado" class="form-control " name="fornecedor">
        <option selected value ="">Escolher...</option>
        <?php 
            if(isset($_GET['id'])){
              echo('<option selected value ="'.$pacote[0]['cnpj'].'">'.$pacote[0]['fornecedor'].'</option>');
            }else
            {
              echo('<option selected value ="">Escolher...</option>');
            }
            foreach($fornecedores as $i){
              echo('<option value="'.$i['cnpj'].'">'.$i['fantasia'].'</option>');
            }
        ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputEstado">Até quantas pessoas?</label>
      <input type="number" class="form-control " id="inputCity" name="qtd_pessoas">
    </div>
    <div class="form-group col-md-2">
      <label for="inputCEP">Período dias</label>
      <input type="number" class="form-control " id="inputCEP" name="periodo">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEstado">Disponibilidade</label>
      <input type="number" class="form-control " id="inputCity" name="qtd">
    </div>
    <div class="form-group col-md-4">
        <label for="inputEstado">Categoria</label>
        <select id="inputEstado" class="form-control " name="categoria">
            <option selected value="null">Escolher...</option>
            <?php 
              foreach($categorias as $i){
                echo('<option value="'.$i['id'].'">'.$i['nome'].'</option>');
              }
            ?>
        </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputEstado">Preço R$</label>
      <input type="number" step="00.0" min="0" class="form-control" id="inputCity" name="preco">
    </div>
  </div>
  <div class="form-group">
      <label>Descrição</label>
      <textarea class="form-control " name="descricao" maxlength="200" hstyle="height:200px;"></textarea>
  </div>
  <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck" name="promocao">
        <label class="form-check-label" for="gridCheck">
            Promoção?
        </label>
        </div>
    </div>
  
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>