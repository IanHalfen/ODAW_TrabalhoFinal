<!DOCTYPE html>
<html lang="en">

  <head>
    

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>Cacic - Login</title>

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
        <?php
        if (!isset($_SESSION['userID'])) {
            // Usuário não está logado, redirecionar para a página de login ou exibir uma mensagem
            //header("Location: contact.php"); // redirecionar para a página de login
            //exit();
        }
        ?>
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
                <a class="nav-link" href="about.html">Sobre Nós</a>
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
                <h4>Minha Conta</h4>
                <h2>Revise seus dados ou deslogue!</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->


    <section class="contact-us">
      <div class="container">
        <div class="row">
  
          <div class="col-lg-12">
            <div class="down-contact">
              <div class="row">
                <div class="col-lg-8">
                  <div class="sidebar-item contact-form">
                    <div class="sidebar-heading">
                      <h2>Meus Dados</h2>
                    </div>
                    <div class="content">
                        <ul>
                      <!-- FORMULARIO DE CRIAR CONTA -->
                        <?php
                            $id_usuario = $_SESSION['userID'];
                            $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";

                            $conexao = mysqli_connect("localhost", "root", "", "cacic_blog");

                            // Verifica se ocorreu um erro na conexão
                            if (!$conexao) {
                                die("Erro na conexão: " . mysqli_connect_error());
                            }

                            $result = mysqli_query($conexao, $sql);
                            $row = mysqli_fetch_assoc($result);

                            echo '<li style="font-size: 18px;">Nome: ' . $row['nome'] . '</li>';
                            echo '<li style="font-size: 18px;">E-mail: ' . $row['email'] . '</li>';
                            echo '<br>';
                            echo '<a href="logout.php"><button  id="deslogin" class="main-button">Deslogar</button></a>';
                        ?>
                        </ul>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
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