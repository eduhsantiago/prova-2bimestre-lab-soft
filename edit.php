<?php
// Configurações de exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o arquivo de conexão com o banco de dados
include_once ('banco.php');

// Inicializa variáveis para evitar erros de "Undefined variable"
$nome = "";
$senha = "";
$nivel_acesso = "";

// Verifica se foi passado um ID válido na URL e se os campos do formulário foram submetidos
if (!empty($_GET['id']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {
    $id = $_GET['id'];

    // Recupera os dados do usuário do banco de dados
    $sqlSelect = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $user_data = mysqli_fetch_assoc($result);
        // Atribui os valores recuperados às variáveis locais
        $nome = $user_data['nome'];
        $senha = $user_data['senha'];
        $nivel_acesso = $user_data['nivel_acesso'];
    }

    // Atualiza os valores no banco de dados com os novos valores do formulário
    $nome_atualizado = $_POST['nome'];
    $senha_atualizada = $_POST['senha'];
    $nivel_acesso_atualizado = $_POST['nivel_acesso'];

    $sqlUpdate = "UPDATE usuarios SET nome = '$nome_atualizado', senha = '$senha_atualizada', nivel_acesso = '$nivel_acesso_atualizado' WHERE id = $id";
    if ($conexao->query($sqlUpdate) === TRUE) {
        echo "Registro atualizado com sucesso!";

        header("Location:admin.php");
    } else {
        echo "Erro ao atualizar registro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Usuário</title>
</head>

<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">
            <input type="text" name="nome" placeholder="Nome de usuário" required value="<?php echo $nome ?>">
            <input type="text" name="senha" placeholder="Senha" value="<?php echo $senha ?>">
            <div class="select-estiloso">
                <select name="nivel_acesso">
                    <option value="admin" <?php echo ($nivel_acesso == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo ($nivel_acesso == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
            </div>
            <button type="submit" name="edit" id="edit">Editar Usuário</button>
        </form>
    </div>
</body>

</html>
