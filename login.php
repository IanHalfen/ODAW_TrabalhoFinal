<?php
  session_start();

  

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $conexao = mysqli_connect("localhost", "root", "", "cacic_blog");

    // Verifica se ocorreu um erro na conexão
    if (!$conexao) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

  echo "<script>console.log(" . "Entrou no login" . ");</script>";
    $consulta = "SELECT * from usuarios WHERE email = '" . $_POST['login_email'] . "' ";
    $query = mysqli_query($conexao, $consulta);
    //Checa se a query deu resultados, caso não
    if($query->num_rows ==0){
        echo '<script>alert("Please verify your username and password.");</script>';
        echo "<script>window.close();</script>";
    }
    $loginInfo = mysqli_fetch_array($query);
    $user_email = $loginInfo[2];
    $password = $loginInfo[3];
    
    if($user_email == $_POST['login_email'] && $password == md5(test_input($_POST['login_senha']))){
        $_SESSION['isLogged'] = true;
        $_SESSION['userID'] = $loginInfo[0];
        echo '<script>alert("Login com sucesso!");</script>';


        echo "<script>window.close();</script>";

        //Ir para página de Admin caso o usuário seja admnistrador
        if($loginInfo[4] == 1){
            #header('Location: index_Admin.php');
            $_SESSION['isAdmin'] = true;
        }
        else
            #header('Location: index_afterLogin.php');
            $_SESSION['isAdmin'] = false;

        header('Location: index.php');
    }

    echo '<script>alert("Please verify your username and password.");</script>';
    echo "<script>window.close();</script>";

    


?>