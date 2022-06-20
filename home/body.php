<?php
  use \Viagens\model\Crud;
  $crud = new Crud();
  $destinos = $crud->select("select id, nome, destino, descricao from produtos limit 3");
  function gera_slides($destinos){

    $ativo = true;
    foreach($destinos as $i){
        echo('<div class="carousel-item ');
        if($ativo == true){
          echo('active">');
          $ativo=false;
        }else{
          echo('">');
        }
        echo('<img class="d-block w-100" style="height:90vh" src="/bootstrap/img/'.$i['destino'].'/1" alt="First slide">');
        echo('<div class="carousel-caption text-left" style="background-color:rgba(0,0,0,0.5);border-radius:20px;padding:20px;">
        <h1 class="display-4">'.$i['nome'].'</h1>');
        echo('<p class="display-5">'.$i['descricao'].'</p>');
        echo('<a class="btn btn-primary" href="/pacote/?id='.$i['id'].'">Saiba mais</a>');
        echo('</div></div>');
    }
  }
  function gera_perfil($destinos){
    foreach($destinos as $i){
      echo('<div class="col-lg-4" style="text-align: center;">');
      echo('<img class="rounded-circle" src="/bootstrap/img/'.$i['destino'].'/1" alt="Generic placeholder image" width="140" height="140">');
      echo('<h2>'.$i['nome'].'</h2>');
      echo('<p>'.$i['descricao'].'</p>');
      echo('<p><a class="btn btn-primary" href="/pacote/?id='.$i['id'].'" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->');
    }
    
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

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="background-color:black">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
  <?php 
      gera_slides($destinos);
    ?>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing" style="margin-top: 50px;">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <?php 
            gera_perfil($destinos);
          ?>
        </div><!-- /.row -->

      
        <hr class="featurette-divider">
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

