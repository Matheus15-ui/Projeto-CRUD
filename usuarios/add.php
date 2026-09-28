    <?php 
        include 'functions.php'; 
        add();
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
	<script src="js/jquery.min.js"></script>
    <h2 class="mt-3">Novo Usuário</h2>

    <form action="add.php" method="post" enctype="multipart/form-data">
        <!-- area de campos do form -->
        <hr>
        <div class="row">
			<div class="form-group col-md-6">
				<label for="nom">Nome:</label>
				<input type="text" class="form-control" id="nom" name="usuario[nome]" maxlength="50" value="">
			</div>

			<div class="form-group col-md-6">
				<label for="log">Login:</label>
				<input type="text" class="form-control" id="log" name="usuario[user]"  maxlength="100" value="">
			</div>
		</div>

		<div class="row  mt-2">
			<div class="form-group col-md-6">
				<label for="senha">Senha:</label><br>
				<input type="password" class="form-control" id="senha" name="usuario[password]" maxlength="100" value="">
			</div>

			<div class="form-group col-md-6">
				<label for="senha2">Confirme a senha:</label><br>
				<input type="password" class="form-control" id="senha2" name="password2" maxlength="100" value="">
			</div>
		</div>

		<div class="row mt-2">
			<div class="form-group col-md-5">
				<label for="img">Foto:</label><br>
				<input type="file" class="form-control" id="img" name="foto" value="" accept="image/*">
			</div>
			<div class="form-group col-md-5">
				<label for="modified">Data de cadastro:</label><br>
				<input type="date" class="form-control" id="modified" name="usuario[modified]" value="" disabled>
			</div>
		</div>

		<div class="form-group col-md-5 mt-2">
			<label for="imgPreview">Pré-visualização:</label><br>
			<img class="img-thumbnail shadow" id="imgPreview" src="fotos/semimagem.jpg" width="150px">
		</div>

		<div id="actions" class="row">
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
<script src="js/jquery.mask.min.js"></script>
<script src="js/bootstrap/bootstrap.bundle.min.js"></script>