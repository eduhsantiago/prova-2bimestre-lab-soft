<?php
    // isset -> serve para saber se uma variável está definida
    include_once('banco.php');
    if(isset($_POST['edit']))
    {
        $id = $_GET['id'];
        $nome = $_POST['nome'];
        $nivel_acesso = $_POST['nivel_acesso'];
        
        $sqlInsert = "UPDATE usuarios 
        SET nome='$nome',senha='$senha',nivel_acesso='$nivel_acesso'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: admin.php');

?>