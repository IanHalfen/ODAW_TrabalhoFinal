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
                <h4>Login</h4>
                <h2>Faça Login ou Crie sua Conta!</h2>
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

        <?php
        // define variables and set to empty values
        $nome = $email = $senha =  $genero = "";
        $nomeErr = $emailErr = $senhaErr =  $generoErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if(empty($_POST["nome"]))
            $nomeErr = "Nome é obrigatório.";
          else{
            $nome = test_input($_POST["nome"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
              $nomeErr = "Apenas letras e espaços brancos são permitidos.";
            }
          }
            

          if(empty($_POST["email"]))
            $emailErr = "E-Mail é obrigatório.";
          else{
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "E-mail inválido.";
            }
          }
            

          if(empty($_POST["senha"]))
            $senhaErr = "Senha é obrigatório.";
          else{
            $senha = test_input($_POST["senha"]);
          }

        }

        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        function resetarValores(){
          $nome = $email = $senha = $genero = "";
          echo "Chamou reset " . $nome. ":";
          echo "console.log(". "Entrou" . ")";
        }
        ?>
        
          <div class="col-lg-12">
            <div class="down-contact">
              <div class="row">
                <div class="col-lg-8">
                  <div class="sidebar-item contact-form">
                    <div class="sidebar-heading">
                      <h2>Não tem conta? Crie Aqui!</h2>
                    </div>
                    <div class="content">
                      <!-- FORMULARIO DE CRIAR CONTA -->
                      <form id="criarConta" action="index.php" method="post">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="nome" type="text" id="nome" placeholder="NOME" required="">
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="email" type="email" id="email" placeholder="E-MAIL" required="">
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <fieldset>
                              <input name="senha" type="password" id="senha" placeholder="SENHA">
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button">CRIAR CONTA</button>
                            </fieldset>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="sidebar-item contact-information">
                    <div class="sidebar-heading">
                      <h2>Login</h2>
                    </div>
                    <div class="content">
                      <!-- FORMULARIO DE FAZER LOGIN -->
                    <form id="login" action="login.php" method="post" target="_blank">
                      <ul>
                        <li>
                        <fieldset>
                              <input name="login_email" type="text" id="login_email" placeholder="E-mail" required="">
                            </fieldset>
                        </li>
                        <li>
                          <fieldset>
                              <input name="login_senha" type="password" id="login_senha" placeholder="Senha" required="">
                          </fieldset>
                        </li>
                        <li>
                          
                          <fieldset>
                              <button type="submit" id="form-login_submit" class="main-button">Entrar</button>
                          </fieldset>
                          </form>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php

            function codificarSenha($senha_digitada){
              $criptografada = md5($senha_digitada);
              return $criptografada;
            }
                    
              if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) )
              {

                if($nomeErr == '' && $emailErr == '' && $senhaErr == ''){
                  $data_nome = $_POST['nome'];
                  $data_email = $_POST['email'];
                  $data_senha = codificarSenha($_POST['senha']);
                  $texto = $data_email . "," . $data_senha . "," . $data_nome . "," . 1 . "\n";
                  //$fp = fopen('autenticacao.txt', 'a+');
                  //fwrite($fp, $texto);
                  //fclose($fp);
                  $consulta = "INSERT INTO usuarios (nome, email, senha, isAdmin) VALUES('". $data_nome ."','". $data_email ."','". $data_senha ."','". 0 ."')";
                  $resultado = mysqli_query($conexao,$consulta);
                  header("location: ex10.html");
                  exit();
                }
              }
          ?>
          
          <div class="col-lg-12">
            <div id="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14313.020679703752!2d-48.855961!3d-26.2533806!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94deafa480d42ae9%3A0xaff6766822b412e1!2sUdesc%20Joinville!5e0!3m2!1sen!2sbr!4v1688252797635!5m2!1sen!2sbr" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
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