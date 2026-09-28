    <?php
        include_once 'functions.php';
        add();
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
    <script src="js/jquery.min.js"></script>
    <h1 class="mt-3">Novo Paciente</h1>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <!-- area de campos do form -->
        <hr>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nom">Nome:</label>
                <input type="text" class="form-control" id="nom" name="paciente[nome]" maxlenght="50" value="" required>
            </div>

            <div class="form-group col-md-6">
                <label for="tp">Endereço:</label>
                <input type="text" class="form-control" id="tp" name="paciente[endereco]" maxlenght="20" value="" required>
            </div>

        </div>

        <div class="row mt-2">

            <div class="form-group col-md-4">
                <label for="tut">Idade:</label>
                <input type="text" class="form-control" id="tut" name="paciente[idade]" maxlength="50" value="" required>
            </div>

            <div class="form-group col-md-4">
                <label for="dtn">Data de Nascimento:</label>
                <input type="date" class="form-control" id="dtn" name="paciente[dataNasc]" value="" required>
            </div>

        </div>

        <div class="row mt-2">
            <div class="form-group col-md-4">
                <label for="img">Foto:</label><br>
				<input type="file" class="form-control" id="img" name="foto" value="" accept="image/*">
            </div>
        </div>

        <div class="form-group col-md-5 mt-2">
            <label for="imgPreview">Pré-visualização:</label><br>
            <img class="img-thumbnail shadow" id="imgPreview" src="fotos/semimagem.jpg" width="150px">
        </div>

        <div id="actions" class="row mt-2">
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i>Salvar</button>
                <a href="index.php" class="btn btn-dark"><i class="fa-solid fa-arrow-rotate-left"></i>Cancelar</a>
            </div>
        </div>
    </form>
<?php include(FOOTER_TEMPLATE); ?>
<script>
    const imageInput = document.getElementById('img');
    const preview = document.getElementById('imgPreview');

    imageInput.addEventListener('change', function(event) {
      const file = event.target.files[0]; // Obtém o arquivo selecionado
      if (file) {
        const reader = new FileReader(); // Cria um leitor de arquivos
        reader.onload = function(e) {
          preview.src = e.target.result; // Define o src da imagem como o conteúdo do arquivo
          preview.style.display = 'block'; // Exibe a imagem
        };
        reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
      } else {
        preview.style.display = 'none'; // Oculta a imagem se nenhum arquivo for selecionado
      }
    });
</script>