<?php
    include "functions.php";


    if(isset($_SESSION['user'])){
        if($_SESSION['user'] != null){
            if (isset($_GET['id'])) {
                try {
                    // Consultando o usuário para obter o nome do arquivo da foto
                    $pet = find('pets', $_GET['id']);

                    // Apagando o usuário do banco de dados
                    remove('pets', $_GET['id']);

                    // Apagando o arquivo da foto, se existir
                    if (!empty($pet['Foto']) && file_exists("fotos/" . $pet['Foto'])) {
                        unlink("fotos/" . $pet['Foto']);
                    }

                    // Mensagem de sucesso
                    $_SESSION['message'] = "Pet excluído com sucesso.";
                    $_SESSION['type'] = "success";

                } catch (Exception $e) {
                    $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
                    $_SESSION['type'] = "danger";
                }
            }
        } else {
            $_SESSION["message"] = "Você precisa ser estar logado para excluir esse pet.";
            $_SESSION["type"] = "danger";
            header("Location:" . BASEURL . "index.php");
        }
    }
    

    // Redireciona de volta para a página inicial
    header("Location: index.php");
    exit;
?>
