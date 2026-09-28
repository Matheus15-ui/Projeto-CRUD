    <?php 
        include 'functions.php'; 
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
    <h2 class="mt-3">Adicionar dono</h2>

    <form action="add.php" method="post">
        <!-- area de campos do form -->
        <hr>
        <div class="row">
			<div class="form-group col-md-7">
				<label for="nom">Nome / Razão Social</label>
				<input type="text" class="form-control" id="nom" name="customer[name]" maxlength="100" value="">
			</div>

			<div class="form-group col-md-3">
				<label for="cpf">CNPJ / CPF</label>
				<input type="tel" class="form-control" id="cpf" name="customer[cpf_cnpj]" maxlength="15" value="">
			</div>

			<div class="form-group col-md-2">
				<label for="dtn">Data de Nascimento</label>
				<input type="date" class="form-control" id="dtn" name="customer[birthdate]" value="">
			</div>
		</div>

		<div class="row mt-2">
			<div class="form-group col-md-5">
				<label for="end">Endereço</label>
				<input type="text" class="form-control" id="end" name="customer[address]"  maxlength="100" value="">
			</div>

			<div class="form-group col-md-3">
				<label for="bai">Bairro</label>
				<input type="text" class="form-control" id="bai" name="customer[hood]" maxlength="100" value="">
			</div>

			<div class="form-group col-md-2">
				<label for="cep">CEP</label>
				<input type="text" class="form-control" id="cep" name="customer[zip_code]" maxlength="8" value="">
			</div>

			<div class="form-group col-md-2">
				<label for="dtc">Data de Cadastro</label>
				<input type="date" class="form-control" id="dtc" name="customer[created]" disabled value="">
			</div>
		</div>

		<div class="row mt-2">
			<div class="form-group col-md-5">
				<label for="cid">Município</label>
				<input type="text" class="form-control" id="cid" name="customer[city]" maxlength="11" value="">
			</div>

			<div class="form-group col-md-2">
				<label for="fone">Telefone</label>
				<input type="tel" class="form-control" id="fone" name="customer[phone]" maxlength="11" value="">
			</div>

			<div class="form-group col-md-2">
				<label for="cel">Celular</label>
				<input type="tel" class="form-control" id="cel" name="customer[mobile]" maxlength="11" value="">
			</div>

			<div class="form-group col-md-1">
				<label for="uf">UF</label>
				<input type="text" class="form-control" id="uf" name="customer[state]" maxlength="2" value="">
			</div>

			<div class="form-group col-md-2">
				<label for="ie">Inscrição Estadual</label>
				<input type="text" class="form-control" id="ie" name="customer[ie]" maxlength="15" value="">
			</div>
		</div>

		<div id="actions" class="row">
			<div class="col-md-12 mt-2">
				<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i>Salvar</button>
				<a href="index.php" class="btn btn-dark"><i class="fa-solid fa-arrow-rotate-left"></i>Cancelar</a>
			</div>
        </div>
    </form>

<?php include(FOOTER_TEMPLATE); ?>
<script src="js/jquery.mask.min.js"></script>
<script src="js/bootstrap/bootstrap.bundle.min.js"></script>