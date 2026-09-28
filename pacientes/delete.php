<?php
    include "functions.php";


    if(isset($_SESSION['user'])){
        if($_SESSION['user'] != null){
            if (isset($_GET['id'])) {
                try {
                    // Consultando o usuário para obter o nome do arquivo da foto
                    $pacientes = find('pacientes', $_GET['id']);

                    // Apagando o usuário do banco de dados
                    remove('pacientes', $_GET['id']);

                    // Apagando o arquivo da foto, se existir
                    if (!empty($pacientes['Foto']) && file_exists("fotos/" . $pacientes['Foto'])) {
                        unlink("fotos/" . $pacientes['Foto']);
                    }

                    // Mensagem de sucesso
                    $_SESSION['message'] = "Paciente excluído com sucesso.";
                    $_SESSION['type'] = "success";

                } catch (Exception $e) {
                    $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
                    $_SESSION['type'] = "danger";
                }
            }
        } else {
            $_SESSION["message"] = "Você precisa ser estar logado para excluir esse paciente.";
            $_SESSION["type"] = "danger";
            header("Location:" . BASEURL . "index.php");
        }
    }
    

    // Redireciona de volta para a página inicial
    header("Location: index.php");
    exit;
?>
