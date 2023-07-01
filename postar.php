<?php
session_start();
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os valores enviados pelo formulário
    $titulo = $_POST["titulo"];
    $categoria = $_POST["categoria"];
    $texto = $_POST["texto"];
    $dataPostagem = date('Y-m-d');
    
    
    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cacic_blog";

    $conexao = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica se ocorreu um erro na conexão
    if (!$conexao) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    if(!$_SESSION['isAdmin'] || !isset($_SESSION['isLogged'])){
        echo '<script>alert("Usuário não é Admnistrador ou não está logado!");</script>';
        echo "<script>window.close();</script>";
        exit();
    }



    
    // Prepara a instrução SQL para inserir os valores na tabela "posts"
    $sql = "INSERT INTO posts (titulo, texto, data_postagem, id_usuario, id_categoria) VALUES ('$titulo', '$texto', '$dataPostagem', '{$_SESSION['userID']}' ,'$categoria')";

    // Executa a instrução SQL
    if ($conexao->query($sql) === TRUE) {
        echo '<script>alert("Post inserido com sucesso!");</script>';
        echo "<script>window.close();</script>";
        header('Location: index.php');
    } else {
        echo '<script>alert("Erro ao inserir Post: '. $conexao->error .'");</script>';
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>
