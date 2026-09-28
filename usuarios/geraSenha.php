<?php
    include("functions.php");
    
    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se o usuário está logado
        if ($_SESSION['user'] != "admin1") { // Verifica se o usuário é admin
            $_SESSION["message"] = "Você precisa ser administrador para acessar essa página.";
            $_SESSION["type"] = "danger";
            header("Location:" . BASEURL . "index.php");
        }
    
    }else{
        $_SESSION["message"] = "Você precisa ser administrador para acessar essa página.";
        $_SESSION["type"] = "danger";
        header("Location:" . BASEURL . "index.php");
    }

    $senha = 'admin';
    $custo = '13';
    $salt = 'Cf1f11ePArKlBJomM0F6aJ';
    
    // Gera um hash baseado em bcrypt
    $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

    echo "<h2>$hash</h2>";


    $options = [
    // Aumenta o custo bcrypt de 12 para 13.
    'cost' => 13,
    ];
    echo "<h2>" . password_hash("admin", PASSWORD_BCRYPT, $options) . "</h2>";
?>