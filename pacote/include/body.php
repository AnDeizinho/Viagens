<?php
  use \Viagens\model\Crud;
  $crud = new Crud();
  $destinos = $crud->select("select id, nome, destino, descricao from produtos");
 
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
            <a class="btn btn-primary" href="/pacote/?id='.$i['id'].'">Saiba mais</a>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" style="width: 500px; height: 500px;" src="/bootstrap/img/'.$i['destino'].'/1" data-holder-rendered="true">
          </div>
        </div>

        <hr class="featurette-divider">');
    }
  }

?>
<main role="main">



      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing" style="margin-top: 50px;">

        <!-- component -->
        <?php 
          gera_corpo($destinos);
        ?>
         <!-- component end -->
        



      </div><!-- /.container -->


<!-- FOOTER -->
<footer class="container">
  <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>
</main>

