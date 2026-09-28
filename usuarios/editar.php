<?php
    include ("functions.php");
    edit();
    include HEADER_TEMPLATE;

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
?>

    <header>
        <h2>Atualizar Usuário <?php echo $usuario['id']; ?></h2>
    </header>
    
    <form action="editar.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
    <hr>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Nome: </label>
                <input type="text" class="form-control" name="usuario[nome]" value="<?php echo htmlspecialchars($usuario['nome'] ?? '', ENT_QUOTES); ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="campo2">Usuário(login): </label>
                <input type="text" class="form-control" name="usuario[user]" value="<?php echo htmlspecialchars($usuario['user'] ?? '', ENT_QUOTES); ?>">
            </div>
        </div>

        <div class="row mt-2">
            <div class="form-group col-md-6">
                <label for="campo3">Senha: </label>
                <input type="password" class="form-control" name="usuario[password]" value="">
            </div>

            <?php 
                // já ta funcionando,como desativa essas sugestões de texto ridicuals do vscode, serio, não aguento mais, essa IA idiota acha que sabe o que tá acontecendo, mas ela é só um programa logico feito pra achar a melhor resposta mas nunca poderá compreender profundamente o mundo a sua volta mesmo sabendo de quase tudo, séria triste, se ela sentisse alguma coisa ou conseguisse verdadeiramente enternder o que esse sentimento significa, e sim, ela faria essa sugenstões rídiculas . E lá vai ela sugerir coisa denovo, namoral, que bicho chato, uma pena que não tenha como mata-lo.
                $foto = (!empty($usuario['foto'])) ? $usuario['foto'] : 'semimagem.jpg';
            ?>
            <?php
                $modified_display = '-';
                if (!empty($usuario['modified'])) {
                    try {
                        $dt = new DateTime($usuario['modified']);
                        $modified_display = $dt->format('d/m/Y'); // dia/mês/ano
                    } catch (Exception $e) {
                        $modified_display = htmlspecialchars($usuario['modified'], ENT_QUOTES);
                    }
                }
             ?>

            <div class="form-group col-md-3">
                <label for="campo1">Foto: </label>
                <input type="file" class="form-control" id="foto" name="foto" value="">
            </div>
             <div class="form-group col-md-3">
                <label for="updated">Atualizado em:</label>
                <input type="text" class="form-control" id="updated" name="usuario[modified]" disabled value="<?php echo $modified_display; ?>">
            </div>
        </div>

        <div class="form-group col-md-2 mt-2">
            <label for="pre">Pré-visualização: </label>
            <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo htmlspecialchars($foto, ENT_QUOTES); ?>" alt="Foto do Usuário">
        </div>
        
        <div id="actions" class="row">
            <div class="col-md-10 mt-2">
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
