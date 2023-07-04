<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>CaCiC - Sobre Nós</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>CACIC<em>.</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <?php
                // Iniciar a sessão
                session_start();
                if(isset($_SESSION['isAdmin'])){
                  if($_SESSION['isAdmin']){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="criarPost.php">Criar Post</a>
                  </li> ';
                  }
                }
                
              ?> 
              <li class="nav-item">
                <a class="nav-link" href="about.php">Sobre Nós</a>
              </li>
              <li class="nav-item">
                <?php
                  if(isset($_SESSION['userID'])){
                    echo '<a class="nav-link" href="minhaconta.php">Minha Conta</a>';
                  }
                  else{
                    echo '<a class="nav-link" href="contact.php">Login</a>';
                  }
                ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>CACiC</h4>
                <h2>Centro Acadêmico de Ciência da Computação</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->


    <section class="about-us">
      <div class="container">
      	
        <div class="row">
          <div class="col-lg-12">
            <p>O Centro Acadêmico de Ciência da Computação (CACiC) da UDESC Joinville é uma entidade estudantil sem fins econômicos e sem filiação política partidária, que representa e promove os estudantes dos cursos do Departamento de Ciência da Computação com prazo de duração indeterminado.</p>
            <p>Dentro das atividades que o CACiC realiza estão a organização de festas, criação e venda de produtos relacionados aos cursos de BCC e TADS, temos contato direto com o DCC e a Direção Geral, representando assim os estudantes em seus interesses e ajudando a direção como um intermediário para a melhor comunicação desses grupos.</p>
            <p>Os atuais membro do CACiC são:</p>
            <ul>
              <li><b>Presidente:</b> Igor Schiessl Froehner</li>
              <li><b>Vice-Presidente:</b> Rodrigo Augusto Krauel</li>
              <li><b>Diretor de Organização:</b> Mariana Rossdeutscher Waltrick Lima</li>
              <li><b>Diretor de Finanças e Patrimônio:</b> Eduardo Pandini</li>
              <li><b>Diretor de Cultura, Esportes e Eventos:</b> Pedro Henrique Serpa de Sousa</li>
              <li><b>Diretor de Comunicação:</b> Ana Beatriz Martins da Silva</li>
              <li><b>Diretor de Integração e Movimentos Sociais:</b> Yuri Becker</li>
              <li><b>Secretário Geral:</b> André de Campos</li>
              <li><b>Primeiro Secretário:</b> Luiz Eugênio Ravache Matos</li>
            </ul>
          </div>
        </div>  
      </div>
    </section>

    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Behance</a></li>
              <li><a href="#">Linkedin</a></li>
              <li><a href="#">Dribbble</a></li>
            </ul>
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>Copyright 2020 Stand Blog Co.
                    
                 | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>