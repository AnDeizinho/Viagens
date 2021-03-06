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
    if( $_POST['id']== 0){
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
    }else{
      $produto['id'] = $_POST['id'];
      $foi = $crud->execute("update produtos set nome = :nome,
    hospedagem = :hospedagem,
    trasport = :trasporte,
    destino = :destino,
    pk_fornecedor = :fornecedor,
    pessoas = :qtd_pessoas,
    dias = :periodo,
    qtd = :qtd,
    pk_categoria = :categoria ,
    preco = :preco,
    descricao = :descricao,
    is_promotion = :is_promotion where id = :id;",$produto);
    }
    
  }
$pacote;
  if(isset($_GET['id'])){
    $pacote = $crud->select("select a.id as id, b.cnpj, a.descricao as descricao, pessoas, dias , a.nome , destino, trasport, hospedagem, qtd, c.nome as categoria, c.id as idcategoria , is_promotion, preco, b.fantasia as fornecedor
    from produtos as a 
    inner join fornecedores as b on a.pk_fornecedor = b.cnpj 
    inner join categorias as c on a.pk_categoria = c.id where a.id = ?", [$_GET['id']]);
   
  }
?>
<form class="container" action="/adm/produto/add/" method="POST">
    <style>
        form{
            margin-top:25px;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="number" hidden name="id" value="<?php echo($_GET['id']);?>">
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
        <option value="A??reo 1?? classe">A??reo 1?? classe</option>
        <option value="A??reo 2?? classe">A??reo 2?? classe</option>
        <option value="A??reo 3?? classe">A??reo 3?? classe</option>
        <option value="Ferrovi??rio">Ferrovi??rio</option>
        <option value="??nibus">??nibus</option>
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
      <label for="inputEstado">At?? quantas pessoas?</label>
      <input type="number" class="form-control " id="inputCity" name="qtd_pessoas" value="<?php echo($pacote[0]['pessoas']);?>">
    </div>
    <div class="form-group col-md-2">
      <label for="inputCEP">Per??odo dias</label>
      <input type="number" class="form-control " id="inputCEP" value="<?php echo($pacote[0]['dias']);?>"  name="periodo">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEstado">Disponibilidade</label>
      <input type="number" class="form-control " id="inputCity" name="qtd" value="<?php echo($pacote[0]['qtd']);?>">
    </div>
    <div class="form-group col-md-4">
        <label for="inputEstado">Categoria</label>
        <select id="inputEstado" class="form-control " name="categoria">
            <?php 
              if(isset($_GET['id'])){
                  echo('<option selected value="'.$pacote[0]['idcategoria'].'">'.$pacote[0]['categoria'].'</option>');
              }else{
                echo('<option selected value="null">Escolher...</option>');
              }
              foreach($categorias as $i){
                echo('<option value="'.$i['id'].'">'.$i['nome'].'</option>');
              }
            ?>
        </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputEstado">Pre??o R$</label>
      <input type="number" step="0.0" value="<?php echo($pacote[0]['preco']);?>" min="0" class="form-control" id="inputCity" name="preco">
    </div>
  </div>
  <div class="form-group">
      <label>Descri????o</label>
      <textarea class="form-control " name="descricao" maxlength="200" hstyle="height:200px;">
        <?php echo($pacote[0]['descricao']);?>
      </textarea>
  </div>
  <div class="form-group">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck" name="promocao" <?php 
        echo($pacote[0]['is_promotion'] == 1? "checked" : "");?>>
        <label class="form-check-label" for="gridCheck">
            Promo????o?
        </label>
        </div>
    </div>
  
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>