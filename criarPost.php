<!DOCTYPE html>
<html lang="en">

  <head>
    

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>Cacic - Criar Post</title>

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
                <h4>Criar Post</h4>
                <h2>Crie um Post para o blog!</h2>
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
        $conexao = mysqli_connect("localhost", "root", "", "cacic_blog");
        $sql = "SELECT * FROM categorias";
        $result = mysqli_query($conexao, $sql);

        // Verifica se ocorreu um erro na conexão
        if (!$conexao) {
            die("Erro na conexão: " . mysqli_connect_error());
        }
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
                      <h2>Criar Post:</h2>
                    </div>
                    <div class="content">
                      <!-- FORMULARIO DE CRIAR POST -->
                      <form id="criarPost" action="postar.php" method="post" target="_blank">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <!-- Título do Post -->
                              <input style="text-transform: none;" name="titulo" type="text" id="titulo" placeholder="Título" required="">
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-sm-12"> 
                            <fieldset>  Categoria: 
                              <!-- Categoria do Post -->
                              <!-- Faz uma consulta no banco de dados e pega todas as categorias que existem -->
                              <select name="categoria">
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></option>
                                <?php endwhile; ?>
                              </select>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <fieldset>
                              <!-- Conteúdo do Post -->
                              <textarea style="text-transform: none;" class="textarea-normal" name="texto" rows="20" id="texto" placeholder="TEXTO DO POST" required=""></textarea>
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button">Criar Post!</button>
                            </fieldset>
                          </div>
                        </div>
                      </form>
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