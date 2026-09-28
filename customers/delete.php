<?php
    include "functions.php";

    if (isset($_SESSION['user'])) {
        if ($_SESSION['user'] != null) {
            if (isset($_GET['id'])) {
                try {
                    // Consultando o usuário para obter o nome do arquivo da foto
                    $customer = find('customers', $_GET['id']);

                    // Apagando o usuário do banco de dados
                    remove('customers', $_GET['id']);

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
