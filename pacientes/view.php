<?php
include('../config.php');
include(DBAPI);
include HEADER_TEMPLATE; 

if (isset($_GET['id'])) {
    $paciente = find('pacientes', $_GET['id']);
}
?>


    <header>
        <h1 class="mt-3">Detalhes do Paciente</h1>
    </header>
    <hr>
    
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <dl class="dl-horizontal">
        <dt>Nome: </dt>
        <dd><?php echo $paciente['nome']; ?></dd>

        <dt>Endereço:</dt>
        <dd><?php echo $paciente['endereco']; ?></dd>

        <dt>Idade</dt>
        <dd><?php echo $paciente['idade']; ?></dd>

        <dt>Data de Nascimento:</dt>
        <dd><?php echo $paciente['dataNasc']; ?></dd>
        <dt>Atualizado em:</dt>

        <dt>Foto:</dt>
        <dd>
            <?php
                if (!empty($paciente['foto']) && file_exists("fotos/" . $paciente['foto'])) {
                    echo "<img src='fotos/" . $paciente ['foto'] . "' class='shadow p-1 mb-1 bg-body rounded' width='300px'>";
                } else {
                    echo "<img src='fotos/semimagem.jpg' class='shadow p-1 mb-1 bg-body rounded' width='300px'>";
                }
            ?>
        </dd>
    </dl>


    <div id="actions" class="row mt-3">
        <div class="col-md-12">
            <?php if (empty($_SESSION['message'])) : ?>
                <a href="editar.php?id=<?php echo $pet['id']; ?>" class="btn btn-secondary">
                    <i class="fa-solid fa-pen-to-square"></i> Editar
                </a>
            <?php endif; ?>
            <a href="index.php" class="btn btn-light">
                <i class="fa-solid fa-rotate-left"></i> Voltar
            </a>
        </div>
    </div>

<?php include FOOTER_TEMPLATE; ?>
