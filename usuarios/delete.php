<?php
    include "functions.php";

    if (isset($_SESSION['user'])) {
        if ($_SESSION['user'] == "admin1") {
            if (isset($_GET['id'])) {
                try {
                    // Consultando o usuário para obter o nome do arquivo da foto
                    $usuario = find('usuarios', $_GET['id']);

                    // Apagando o usuário do banco de dados
                    remove('usuarios', $_GET['id']);

                    // Apagando o arquivo da foto, se existir
                    if (!empty($usuario['foto']) && file_exists("fotos/" . $usuario['foto'])) {
                        unlink("fotos/" . $usuario['foto']);
                    }

                    // Mensagem de sucesso
                    $_SESSION['message'] = "Usuário excluído com sucesso.";
                    $_SESSION['type'] = "success";

                } catch (Exception $e) {
                    $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
                    $_SESSION['type'] = "danger";
                }
            }
        } else{
            $_SESSION["message"] = "Você precisa ser administrador para excluir um usuário.";
            $_SESSION["type"] = "danger";
            header("Location:" . BASEURL . "index.php");
        }
    }

    // Redireciona de volta para a página inicial
    header("Location: index.php");
    exit;
?>
