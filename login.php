<?php

session_start();
require_once ('banco.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    

    $query = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];

        if ($usuario['nivel_acesso'] == 'admin') {
            header('location: admin.php');
        } else{
            header('location:usuario.php');
        }
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
        <h2>login</h2>
        <input type="text" name="nome" id="" placeholder="usuário" required>
        <input type="password" name="senha" id="" placeholder="senha" required>
        <button type="submit" >entrar</button>
        </form>
    </div>
</body>
</html>