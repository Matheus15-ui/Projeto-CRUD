<?php
    include "functions.php";
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

    if(isset($_GET["pdf"])){
        if($_GET["pdf"] == "ok" ){
            pdf();
        } else{
            pdf($_GET["pdf"]);
        }
    }
    index();
    include HEADER_TEMPLATE;
?>

<header class="mb-4 mt-4">
    <h2>Usuários</h2>
    <div class="mt-2 row mb-2 text-center">

        <div class="col-md-6">
            <form name="filtro" action="index.php" method="post">
                <div class="input-group">
                    <input type="search" class="form-control" name="users" maxlength="80" required>
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i> Consultar
                    </button>
                        <a class="btn btn-light" href="index.php"> <i class="fas fa-sync-alt"></i>Atualizar</a>
                   
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex justify-content-end">
            <a class="btn btn-secondary me-2" href="add.php">
                <i class="fa-solid fa-user-plus"></i> Novo usuário  
            </a>  
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <a class="btn btn-dark" href="index.php?pdf=<?php echo  $_POST['users']; ?>" Download> <i class="fa-solid fa-file-pdf"></i>Listagem</a>
            <?php else :?>
                <a class="btn btn-dark" href="index.php?pdf=ok" Download> <i class="fa-solid fa-file-pdf"></i>Listagem</a>
            <?php endif ;?>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<hr>

<table class="table table-hover text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Nome</th>
            <th>Login</th>
            <th>Foto</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($usuarios) : ?>
    <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td align='center'><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['user']; ?></td>
            <td>
                <?php 
                    if (!empty($usuario['foto'])) {
                        echo "<img src='fotos/" . $usuario['foto'] . "' class='shadow p-1 mb-1 bg-body rounded' width='100px'>";
                    } else {
                        echo "<img src='fotos/semimagem.jpg' class='shadow p-1 mb-1 bg-body rounded' width='100px'>";
                    }
                ?>
            </td>
            <td class="actions text-left">
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin1') : ?>
                    <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
                    <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                    <a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-usuario" data-customer="<?php echo $usuario['id']; ?>">
                        <i class="fa-solid fa-trash-can"></i> Excluir
                    </a>
                <?php else: ?>
                    <!-- botão limitado para usuários não-admin -->
                    <span class="text-muted">Sem permissão</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6">Nenhum registro encontrado.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<?php 
    include "modal.php"; 
    include FOOTER_TEMPLATE;
?>