<?php
session_start();
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $comentario = $_POST['comentario'];
    
    // Validação dos dados (pode adicionar outras validações conforme necessário)
    if (empty($comentario)) {
        echo 'Por favor, preencha todos os campos.';
        exit;
    }
    
    // Conexão com o banco de dados (substitua os valores conforme suas configurações)
    $conexao = mysqli_connect('localhost', 'root', '', 'cacic_blog');
    if (!$conexao) {
        echo 'Erro ao conectar ao banco de dados: ' . mysqli_connect_error();
        exit;
    }
    $data_enviado = date('Y-m-d');
    // Prepara a consulta SQL
    $sql = "INSERT INTO comentarios (texto, data_enviado, id_usuario, id_post) VALUES ('$comentario', '$data_enviado', '" . $_SESSION['userID'] . "', '" . $_GET['post_id'] . "')";

    
    // Executa a consulta SQL
    if (mysqli_query($conexao, $sql)) {
        echo '<script>alert("Comentário feito com sucesso!\n");</script>';
    } else {
        echo '<script>alert("Usuário não é Administrador ou não está logado!\n' . mysqli_error($conexao) . '");</script>';
    }
    header('Location: post-details.php?id=' . $_GET['post_id']);

    
    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
