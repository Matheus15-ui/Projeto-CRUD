<?php
    include('functions.php');
    edit();
    include HEADER_TEMPLATE; 

    if (!isset($_SESSION)) session_start();
    if (isset($_SESSION['user'])) { // Verifica se o usuário está logado
        if ($_SESSION['user'] == null) { // Verifica se o usuário é admin
            $_SESSION["message"] = "Você precisa ser administrador para acessar essa página.";
            $_SESSION["type"] = "danger";
            header("Location:" . BASEURL . "index.php");
        }
    
    }else{
        $_SESSION["message"] = "Você precisa ser administrador para acessar essa página.";
        $_SESSION["type"] = "danger";
        header("Location:" . BASEURL . "index.php");
    }
?>

<header>
    <h1>Editar Pet</h1>
</header>

<form action="editar.php?id=<?php echo isset($pet['id']) ? $pet['id'] : ''; ?>" method="post" enctype="multipart/form-data">
<hr>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Nome: </label>
            <input type="text" class="form-control" id="name" name="pet[Nome]" value="<?php echo htmlspecialchars($pet['Nome'] ?? '', ENT_QUOTES); ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="tp">Tipo:</label>
            <input type="text" class="form-control" id="tp" name="pet[Tipo]" maxlength="20" value="<?php echo htmlspecialchars($pet['Tipo'] ?? '', ENT_QUOTES); ?>" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-4">
            <label for="tut">Tutor:</label>
            <input type="text" class="form-control" id="tut" name="pet[Tutor]" maxlength="50" value="<?php echo htmlspecialchars($pet['Tutor'] ?? '', ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group col-md-4">
            <label for="dtn">Data de Nascimento:</label>
            <input type="date" class="form-control" id="dtn" name="pet[DataNasc]" value="<?php echo htmlspecialchars($pet['DataNasc'] ?? '', ENT_QUOTES); ?>" required>
        </div>
    </div>

    <?php
        $modified_display = '-';
        if (!empty($pet['modified'])) {
            try {
                $dt = new DateTime($pet['modified']);
                $modified_display = $dt->format('d/m/Y'); // dia/mês/ano
            } catch (Exception $e) {
                $modified_display = htmlspecialchars($pet['modified'], ENT_QUOTES);
            }
        }
    ?>

    <div class="row mt-2">
        <?php 
            $foto = (!empty($pet['Foto'])) ? $pet['Foto'] : 'semimagem.jpg';
        ?>

        <div class="form-group col-md-4">
            <label for="updated">Atualizado em:</label>
            <input type="text" class="form-control" id="updated" name="pet[modified]" disabled value="<?php echo $modified_display; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="foto">Foto:</label>
            <input type="file" class="form-control" id="foto" name="Foto" value="">
        </div>

    </div>

    <div class="form-group col-md-2 mt-2">
        <label for="pre">Pré-visualização: </label>
        <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo htmlspecialchars($foto, ENT_QUOTES); ?>" alt="Foto do pet">
    </div>

    <div id="actions" class="row">
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
            <a href="index.php" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i>Cancelar</a>
        </div>
    </div>
</form>

<?php include FOOTER_TEMPLATE; ?>

<script>
    $(document).ready(() => {
        $('#foto').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

