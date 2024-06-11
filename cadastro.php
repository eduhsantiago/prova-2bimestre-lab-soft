<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ('banco.php');
session_start();

if(!isset($_SESSION['id']) || $_SESSION['nivel_acesso'] != 'admin'){
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $nivel_acesso = $_POST['nivel_acesso'];

    $query = "INSERT INTO usuarios(nome, senha, nivel_acesso) VALUES ('$nome', '$senha', '$nivel_acesso')";

    if (mysqli_query($conexao, $query)) {
        header('Location:login.php');
    } else {
        echo ("erro ao cadastrar usuarios");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h2>cadastrar</h2>
        <form action="cadastro.php" method="post">
            <input type="text" name="nome" placeholder="nome de usuário" required>
            <input type="password" name="senha" id="" placeholder="senha">
            <div class="select-estiloso">
                <select name="nivel_acesso">
                    <option>admin</option>
                    <option>user</option>
                </select>
            </div>
            <button type="submit" name="query">cadastrar usuário</button>
        </form>
    </div>
</body>

</html>