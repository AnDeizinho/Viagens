<?php 
    use \Viagens\model\Crud;
    include "../../model/crud.php";
    $crud = new Crud();
    $lista = $crud->select("select a.id as id, a.nome, destino, hospedagem, qtd, c.nome as categoria, is_promotion, preco, b.fantasia as fornecedor
    from produtos as a 
    inner join fornecedores as b on a.pk_fornecedor = b.cnpj 
    inner join categorias as c on a.pk_categoria = c.id;");
?>

<main role="main">
    <style>
        main{
            overflow-x: scroll;
            overflow-y: scroll;

            height: 88vh;
        }
    </style>
<table class="table table-striped container">
  <thead class="thead">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Destino</th>
      <th scope="col">Hospedagem</th>
      <th scope="col">Disponível</th>
      <th scope="col">Categoria</th>
      <th scope="col">Promocao</th>
      <th scope="col">Valor</th>
      <th scope="col">Fornecedor</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    foreach($lista as $i){
      echo("<tr>");
      echo("<td>".$i['nome']."</td>");
      echo("<td>".$i['destino']."</td>");
      echo("<td>".$i['hospedagem']."</td>");
      echo("<td>".$i['qtd']."</td>");
      echo("<td>".$i['categoria']."</td>");
      echo("<td>".($i['is_promotion'] == 1? "Sim" : "Não")."</td>");
      echo("<td>".$i['preco']."</td>");
      echo("<td>".$i['fornecedor']."</td>");
      echo("<td>");
      echo('<a class="btn btn-primary" style="color:white;" href="add/?id='.$i['id'].'">Alterar</a>');
      echo('<a class="btn btn-danger" style="color:white;" href="del/?id='.$i['id'].'">Deletar</a>');
      echo("</td></tr>");
    }
    
    ?>
  </tbody>
</table>
</main>

