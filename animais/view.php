<?php
include('../config.php');
include(DBAPI);

if (!isset($_SESSION)) session_start();
include HEADER_TEMPLATE; 
if (isset($_GET['id'])) {
    $pet = find('pets', $_GET['id']);
}
?>


    <header>
        <h1 class="mt-3">Detalhes do Pet</h1>
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
        <dd><?php echo $pet['Nome']; ?></dd>

        <dt>Tipo:</dt>
        <dd><?php echo $pet['Tipo']; ?></dd>

        <dt>Tutor:</dt>
        <dd><?php echo $pet['Tutor']; ?></dd>

        <dt>Atualizado em:</dt>
        <dd>
            <?php
                if (!empty($pet['modified'])) {
                    try {
                        $dt = new DateTime($pet['modified']);
                        echo $dt->format('d/m/Y'); // use 'd/m/Y H:i' para incluir hora
                    } catch (Exception $e) {
                        echo htmlspecialchars($pet['modified']);
                    }
                } else {
                    echo '-';
                }
            ?>
        </dd>

        <dt>Foto:</dt>
        <dd>
            <?php
                if (!empty($pet['Foto']) && file_exists("fotos/" . $pet['Foto'])) {
                    echo "<img src='fotos/" . $pet['Foto'] . "' class='shadow p-1 mb-1 bg-body rounded' width='300px'>";
                } else {
                    echo "<img src='fotos/semimagem.jpg' class='shadow p-1 mb-1 bg-body rounded' width='300px'>";
                }
            ?>
        </dd>
    </dl>


    <div id="actions" class="row mt-3">
        <div class="col-md-12">
            <?php if (isset($_SESSION['user'])) : ?>
                <?php if ($_SESSION['user'] == "admin1") : ?>
                    <a href="editar.php?id=<?php echo $pet['id']; ?>" class="btn btn-secondary">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="index.php" class="btn btn-light">
                <i class="fa-solid fa-rotate-left"></i> Voltar
            </a>
        </div>
    </div>

<?php include FOOTER_TEMPLATE; ?>
