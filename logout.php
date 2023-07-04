<?php
session_start();

// Remova as variáveis de sessão relevantes
unset($_SESSION['userID']); // Exemplo de variável de sessão a ser removida
unset($_SESSION['isLogged']);
unset($_SESSION['isAdmin']);
// Remova outras variáveis de sessão, se necessário

// Destrua a sessão
session_destroy();

// Redirecionar para a página de login
header('Location: contact.php');
exit;
?>
