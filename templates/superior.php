<?php 
  session_start();
  $login=[];
  if(isset($_SESSION['nome'])){
    $login['btn'] = "sair";
    $login['url'] = "/login/sair.php";
  }else
  {
    $login['btn'] = "Entrar";
    $login['url']="/login";
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo($_SESSION['titulo']);?></title>

    <!-- Bootstrap -->

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/bootstrap/css/all.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->

    
    
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><?php echo($_SESSION['nome']);?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/pacote">Pacotes</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/sobre">Quem somos</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="/parceiros">Parcerias</a>
          </li>
        </ul>

          <ul class="navbar-nav">
            <li class="nav-item dropdown">
                  <a style="margin-right: 70px;" class="btn btn-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Perfil
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  if(isset($_SESSION['fk_cliente'])){
                  echo('<a class="dropdown-item" href="/cliente/?cpf='.$_SESSION['fk_cliente'].'">Dados</a>
                  <a class="dropdown-item" href="/cliente/card/?cpf='.$_SESSION['fk_cliente'].'">Pagamento</a>');
                  }?>  
                  <a class="dropdown-item" href="<?php echo($login['url']); ?>"><?php echo($login['btn']); ?></a>
                  </div>
                </li>
            </ul>
      </div>
  </nav>

  