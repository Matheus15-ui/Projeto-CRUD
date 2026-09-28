<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Pet Shop</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo BASEURL; ?>lf_icon.ico" type="image/x-icon">

        <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }

        </style>

        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/cookie-consent.css">
    </head>
<body>
    <nav class="navbar navbar-expand-md fixed-top "  data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo BASEURL; ?>"><i class="fa-solid fa-house-chimney"></i> CRUD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbaritens" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbaritens">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i> Donos
              </a>
              <ul class="dropdown-menu">
                <?php if(isset($_SESSION['user'])) : ?>
                  <?php if($_SESSION['user'] != null) : ?>
                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo dono</a></li>
                  <?php endif; ?>
		            <?php endif; ?>
                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Gerenciar donos</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-paw"></i> Pets
              </a>
              <ul class="dropdown-menu">
                <?php if(isset($_SESSION['user'])) : ?>
                  <?php if($_SESSION['user'] != null) : ?>
                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>animais/add.php"><i class="fa-solid fa-shield-dog"></i></i> Novo pet</a></li>
                  <?php endif; ?>
		            <?php endif; ?>
                <li><a class="dropdown-item" href="<?php echo BASEURL; ?>animais"><i class="fa-solid fa-paw"></i> Gerenciar pets</a></li>
              </ul>
            </li>
            <?php if(isset($_SESSION['user'])) : //Verifica se está logado?>
              <?php if($_SESSION['user'] == 'admin1') : //Verifica se está logado como admin?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-lock"></i> Usuários
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-tie"></i> Adicionar usuários</a></li>
                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/"><i class="fa-solid fa-user-lock"></i> Gerenciar usuários</a></li>
                  </ul>
                </li>
              <?php endif; ?>
               <?php if($_SESSION['user'] == 'admin1') : //Verifica se está logado como admin de novo caramba amba?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-star-of-life"></i> Pacientes
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>pacientes/add.php"><i class="fa-solid fa-file-medical"></i> Adicionar pacientes</a></li>
                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>pacientes/"><i class="fa-solid fa-star-of-life"></i> Gerenciar pacientes</a></li>
                  </ul>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                  <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                </a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                  <i class="fa-solid fa-users"></i> Login
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    
    <main class="container">