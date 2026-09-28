<?php 
    // Esse é o valida.php
    include("../config.php");
    require_once(DBAPI);
    include(HEADER_TEMPLATE);

    //Verifica se houve POST e se o usuário ou a senha estão vazio
    if (!empty($_POST) and (empty($_POST['login']) or empty($_POST['senha']))) {
        header("Location:" . BASEURL . "index.php");
        exit;
    }

    // Tenta se conectar a um banco de dados MySQL
    $bd = open_database();
    try {

        // pegando o login e senha digitado no form
        $usuario = $_POST['login'];
        $senha = $_POST['senha'];
        // testando para ver  se o login e senha digitado no form não estão vazios
        if (!empty($usuario) && !empty($senha)) {
            // pegando a senha digitada no form e criptografando ela para poder comparar
            // a função de criptografia FOI MOVIDA para o arquivo database.php (DBAPI)
            // Validação do usuário/senha digitados
            $stmt = $bd -> prepare("SELECT id, nome, user, password FROM usuarios WHERE (user = ?) LIMIT 1");
            $stmt -> execute([$usuario]);

            $dados = $stmt -> fetch();
            if (verificar_senha($senha, $dados['password'])) {
                // echo "<b>";
                // var_dump($dados);
                // echo "</b>";
                $id = $dados['id'];
                $nome = $dados['nome'];
                $user = $dados['user'];
                $password = $dados['password'];
                 //var_dump($user);
                // verifica  se $user não está vazio
            
                if (!isset($_SESSION)) session_start(); {
                    $_SESSION['message'] = "Bem vindo " . $nome . "!";
                    $_SESSION['type'] = 'info';
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['user'] = $user;
                    // echo "<b>";
                    // var_dump($user);
                    // echo "</b>";
                }

            } else {
                // mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
                throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.", 1);
            }
        } else {
            // mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
            throw new Exception("Não foi possível se conectar!<br>Verifique seu usuário e senha.", 1);
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro: " . $e -> getMessage();
        $_SESSION['type'] = 'danger';
    }
?>

    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php clear_messages(); ?>
    <?php endif; ?>
    <header>
        <a href="<?php echo BASEURL; ?>index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
    </header>
<?php include(FOOTER_TEMPLATE); ?>