<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>CaCic Blog</title>

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

    <?php
    



    $conexao = mysqli_connect("localhost", "root", "", "cacic_blog");

    // Verifica se ocorreu um erro na conexão
    if (!$conexao) {
        die("Erro na conexão: " . mysqli_connect_error());
    }
    //echo "Conexão ao banco de dados estabelecida com sucesso";

            function codificarSenha($senha_digitada){
              $criptografada = md5($senha_digitada);
              return $criptografada;
            }
                    
              if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) )
              {
                  $data_nome = $_POST['nome'];
                  $data_email = $_POST['email'];
                  $data_senha = codificarSenha($_POST['senha']);
                  $texto = $data_email . "," . $data_senha . "," . $data_nome . "," . 1 . "\n";
                  //$fp = fopen('autenticacao.txt', 'a+');
                  //fwrite($fp, $texto);
                  //fclose($fp);
                  $consulta = "INSERT INTO usuarios (nome, email, senha, isAdmin) VALUES('". $data_nome ."','". $data_email ."','". $data_senha ."','". 0 ."')";
                  $resultado = mysqli_query($conexao,$consulta);
                  //header("location: ex10.html");
                  //exit();
                
              }
          ?>


    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">
          
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->


    <!-- POSTS DO BLOG AQUI----------------------------------------------------------------->
    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <?php
                  // Verifica se um termo de pesquisa foi fornecido
                  //var_dump($_GET['categoria']);
                  if (isset($_GET['query'])) {
                    // Obtém o termo de pesquisa
                    $searchTerm = $_GET['query'];
                    $sql = "SELECT posts.*, categorias.nome AS nome_categoria, usuarios.nome AS nome_usuario,
                                (SELECT COUNT(*) FROM comentarios WHERE comentarios.id_post = posts.id) AS total_comentarios
                                FROM posts INNER JOIN categorias ON posts.id_categoria = categorias.id 
                                INNER JOIN usuarios ON posts.id_usuario = usuarios.id
                                WHERE titulo LIKE '%$searchTerm%'
                                ORDER BY id DESC";

                    $result = mysqli_query($conexao, $sql);

                      // Verifica se há resultados
                    if ($result && mysqli_num_rows($result) > 0) {
                        // Reposiciona o ponteiro de resultados para o último registro (Faz os posts ficrem ordenados de mais recente até oo mais velho)
                        //mysqli_data_seek($result, mysqli_num_rows($result) - 1);

                        while ($row = mysqli_fetch_assoc($result)) {



                          echo '<div class="col-lg-12">';
                          echo '<div class="blog-post">';
                          echo '<div class="blog-thumb"> <img src="assets/images/blog-post-01.jpg" alt=""> </div>';

                          //CATEGORIA DO POST
                          echo '<div class="down-content">';
                          echo '<span>' . $row['nome_categoria']. '</span>';

                          //TÍTULO DO POST
                          echo '<a href="post-details.php?id=' . $row['id'] . '"><h4>' . $row['titulo'] . '</h4></a>';

                          //DADOS DO POST
                          echo '<ul class="post-info">';
                          echo  '<li><a href="#">' . $row['nome_usuario'] . '</a></li>';
                          echo '<li><a href="#">' . $row['data_postagem'] . '</a></li>';
                          echo '<li><a href="#">' . $row['total_comentarios'] . ' Comentários</a></li>';  // <--------------------MUDAR DEPOIS DE ADICIONAR COMENTÁRIOS
                          echo '</ul>';

                          //TEXTO DO POST
                          $maxLength = 200;
                          $texto = $row['texto'];
                          $isLarger = false;
                          if (strlen($texto) > $maxLength) {
                              $texto = substr($texto, 0, $maxLength) . '...'; // Limita o texto e adiciona reticências
                              $link = '<a href="post-details.php?id=' . $row['id'] . '">Ler mais</a>'; // Cria o link para a página post_details.php com o ID do post
                              echo '<p>' . nl2br($texto) . ' ' . $link . '</p>';
                          }
                          else
                            echo '<p>' . nl2br($texto) . '</p>';
                          

                            //OPÇÕES DO POST
                            echo '<div class="post-options">';
                            echo '<div class="row">';

                            echo '<div class="col-6">';
                            echo '<ul class="post-tags">';
                            echo '<li><i class="fa fa-tags"></i></li>';
                            echo '<li><a href="#">' . $row['nome_categoria'] . '</a></li>';
                            echo '</ul>';
                            echo '</div>';

                            echo '<div class="col-6">';
                            echo '<ul class="post-share">';
                            echo '<li><i class="fa fa-share-alt"></i></li>';
                            echo '<li><a href="#">Facebook</a>,</li>';
                            echo '<li><a href="#"> Twitter</a></li>';
                            echo '</ul>';
                            echo '</div>';

                            echo '</div>';
                            echo '</div>';

                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                  }
                  else {
                    echo 'Nenhum resultado encontrado.';
                  }
                  
                  }
                  else if(isset($_GET['categoria'])){
                    // Obtém o termo de pesquisa
                    //$searchTerm = $_GET['categoria'];
                    //var_dump($_GET['categoria']);
                    $sql = "SELECT posts.*, categorias.nome AS nome_categoria, usuarios.nome AS nome_usuario,
                              (SELECT COUNT(*) FROM comentarios WHERE comentarios.id_post = posts.id) AS total_comentarios
                              FROM posts INNER JOIN categorias ON posts.id_categoria = categorias.id 
                              INNER JOIN usuarios ON posts.id_usuario = usuarios.id
                              WHERE id_categoria = '{$_GET['categoria']}'
                              ORDER BY id DESC";

            

                  $result = mysqli_query($conexao, $sql);

                    // Verifica se há resultados
                  if ($result && mysqli_num_rows($result) > 0) {
                      // Reposiciona o ponteiro de resultados para o último registro (Faz os posts ficrem ordenados de mais recente até oo mais velho)
                      //mysqli_data_seek($result, mysqli_num_rows($result) - 1);

                      while ($row = mysqli_fetch_assoc($result)) {



                        echo '<div class="col-lg-12">';
                        echo '<div class="blog-post">';
                        echo '<div class="blog-thumb"> <img src="assets/images/blog-post-01.jpg" alt=""> </div>';

                        //CATEGORIA DO POST
                        echo '<div class="down-content">';
                        echo '<span>' . $row['nome_categoria']. '</span>';

                        //TÍTULO DO POST
                        echo '<a href="post-details.php?id=' . $row['id'] . '"><h4>' . $row['titulo'] . '</h4></a>';

                        //DADOS DO POST
                        echo '<ul class="post-info">';
                        echo  '<li><a href="#">' . $row['nome_usuario'] . '</a></li>';
                        echo '<li><a href="#">' . $row['data_postagem'] . '</a></li>';
                        echo '<li><a href="#">' . $row['total_comentarios'] . ' Comentários</a></li>';  // <--------------------MUDAR DEPOIS DE ADICIONAR COMENTÁRIOS
                        echo '</ul>';

                        //TEXTO DO POST
                        $maxLength = 200;
                        $texto = $row['texto'];
                        $isLarger = false;
                        if (strlen($texto) > $maxLength) {
                          $texto = substr($texto, 0, $maxLength) . '...'; // Limita o texto e adiciona reticências
                          $link = '<a href="post-details.php?id=' . $row['id'] . '">Ler mais</a>'; // Cria o link para a página post_details.php com o ID do post
                          echo '<p>' . nl2br($texto) . ' ' . $link . '</p>';
                        }
                        else
                          echo '<p>' . nl2br($texto) . '</p>';
                        

                        //OPÇÕES DO POST
                        echo '<div class="post-options">';
                        echo '<div class="row">';

                        echo '<div class="col-6">';
                        echo '<ul class="post-tags">';
                        echo '<li><i class="fa fa-tags"></i></li>';
                        echo '<li><a href="#">' . $row['nome_categoria'] . '</a></li>';
                        echo '</ul>';
                        echo '</div>';

                        echo '<div class="col-6">';
                        echo '<ul class="post-share">';
                        echo '<li><i class="fa fa-share-alt"></i></li>';
                        echo '<li><a href="#">Facebook</a>,</li>';
                        echo '<li><a href="#"> Twitter</a></li>';
                        echo '</ul>';
                        echo '</div>';

                        echo '</div>';
                        echo '</div>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                      }
                    
                  }
                  else {
                    echo 'Nenhum resultado encontrado.';
                  }
                }
                  else {
                    echo 'Nenhum resultado encontrado.';
                  }
                ?>
                
              
                
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                  <form id="search_form" name="gs" method="GET" action="search.php">
                      <input type="text" name="query" class="searchText" placeholder="Digite para pesquisar..." autocomplete="on">
                    </form>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                      <h2>Posts Recentes</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php
                          //consulta SQL para recuperar os posts do banco de dados
                          $sql = "SELECT posts.*, categorias.nome AS nome_categoria, usuarios.nome AS nome_usuario,
                          (SELECT COUNT(*) FROM comentarios WHERE comentarios.id_post = posts.id) AS total_comentarios
                                      FROM posts INNER JOIN categorias ON posts.id_categoria = categorias.id 
                                      INNER JOIN usuarios ON posts.id_usuario = usuarios.id
                                      ORDER BY id DESC";
                          $result = mysqli_query($conexao, $sql);

                          // Verifica se há resultados
                          if ($result) {
                            $i = 0; // Limite máximo de posts recentes
                            

                            while ($row = mysqli_fetch_assoc($result)) {
                              echo '<li>';
                              echo '<a href="post-details.php?id=' . $row['id'] . '"><h5>' . $row['titulo'] . '</h5></a>';
                              echo '<span>' . $row['data_postagem'] . '</span>';
                              echo '</a></li>';

                              $i++;
                              if($i>=3){
                                break;
                              }
                            }
                          }
                          ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                      <h2>Categorias</h2>
                    </div>
                    <div class="content">
                      <ul>
                            <?php
                              $sql = "SELECT * FROM categorias";
                              $result = mysqli_query($conexao, $sql);
                              
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li><a href="search.php?categoria=' . $row['id'] . '">- ' . $row['nome'] . '</a></li>';
                            }
                            
                            
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