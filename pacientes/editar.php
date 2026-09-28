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

<form action="editar.php?id=<?php echo isset($paciente['id']) ? $paciente['id'] : ''; ?>" method="post" enctype="multipart/form-data">
<hr>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="name">Nome: </label>
            <input type="text" class="form-control" id="name" name="paciente[nome]" value="<?php echo htmlspecialchars($paciente['nome'] ?? '', ENT_QUOTES); ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="tp">endereço:</label>
            <input type="text" class="form-control" id="tp" name="paciente[endereco]" maxlength="20" value="<?php echo htmlspecialchars($paciente['endereco'] ?? '', ENT_QUOTES); ?>" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-4">
            <label for="tut">Idade</label>
            <input type="number" class="form-control" id="tut" name="paciente[idade]" maxlength="50" value="<?php echo htmlspecialchars($paciente['idade'] ?? '', ENT_QUOTES); ?>" required>
        </div>

        <div class="form-group col-md-4">
            <label for="dtn">Data de Nascimento:</label>
            <input type="date" class="form-control" id="dtn" name="paciente[dataNasc]" value="<?php echo htmlspecialchars($paciente['dataNasc'] ?? '', ENT_QUOTES); ?>" required>
        </div>
    </div>

  
    <div class="row mt-2">
        <?php 
            $foto = (!empty($paciente['foto'])) ? $paciente['foto'] : 'semimagem.jpg';
        ?>

        <div class="form-group col-md-4">
            <label for="foto">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto" value="">
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

