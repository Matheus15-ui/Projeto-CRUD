<?php 
    // Esse é o logout.php
    include("../config.php");
    try {
        session_start(); //incia a sessão ou acessa a sessão existente
        session_destroy(); // destroi a sessão limpando todos os valores salvos
        header("Location: " . BASEURL . "index.php"); // Direciona para o index do site
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro" . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
?>