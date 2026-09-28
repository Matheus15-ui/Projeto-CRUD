<?php
include 'functions.php';

// debug temporário: verifique se chegou POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("POST em editar.php: " . print_r($_POST, true));
    // para ver no browser (apenas enquanto debug)
    // echo '<pre>' . htmlspecialchars(print_r($_POST,true)) . '</pre>';
}
edit();

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
  
include HEADER_TEMPLATE;
?>

<h2 class="mt-3">Editar Cliente <?php echo $customer['id']?></h2>

<form action="editar.php?id=<?php echo $customer['id']; ?>" method="post" enctype="multipart/form-data">
  <hr>
  <input type="hidden" name="customer[id]" value="<?php echo $customer['id']; ?>">

  <div class="row">
    <div class="form-group col-md-5">
      <label for="nom">Nome:</label>
      <input type="text" class="form-control" id="nom" name="customer[name]" maxlength="100" value="<?php echo $customer['name']; ?>" required>
    </div>

    <div class="form-group col-md-4">
      <label for="cpf" >CNPJ / CPF:</label>
      <input type="tel" class="form-control" id="cpf" name="customer[cpf_cnpj]" maxlength="15" value="<?php echo $customer['cpf_cnpj']; ?>" required>
    </div>

    <div class="form-group col-md-3">
      <label for="dtn">Data de Nascimento:</label>
				<input type="date" class="form-control" id="dtn" name="customer[birthdate]" value="" required>
    </div>
  </div>
  
  <div class="row mt-2">

    <div class="form-group col-md-5">
      <label for="end">Endereço:</label>
				<input type="text" class="form-control" id="end" name="customer[address]"  maxlength="100" value="<?php echo $customer['address']; ?>" required>
    </div>

    <div class="form-group col-md-4">
      <label for="bai">Bairro:</label>
				<input type="text" class="form-control" id="bai" name="customer[hood]" maxlength="100" value="<?php echo $customer['hood']; ?>" required>
    </div>

    <div class="form-group col-md-3">
      <label for="cep">CEP:</label>
				<input type="text" class="form-control" id="cep" name="customer[zip_code]" maxlength="8" value="<?php echo $customer['zip_code']; ?>" required>
    </div>
  </div>

  <div class="row mt-2">

    <div class="form-group col-md-5">
      <label for="cid">Município:</label>
				<input type="text" class="form-control" id="cid" name="customer[city]" maxlength="11" value="<?php echo $customer['city']; ?>" required>
    </div>

    <div class="form-group col-md-2">
				<label for="fone">Telefone:</label>
				<input type="tel" class="form-control bd" id="fone" name="customer[phone]" maxlength="11" value="<?php echo $customer['phone']; ?>">
			</div>

			<div class="form-group col-md-2">
				<label for="cel">Celular:</label>
				<input type="tel" class="form-control bd" id="cel" name="customer[mobile]" maxlength="11" value="<?php echo $customer['mobile']; ?>">
			</div>

			<div class="form-group col-md-1">
				<label for="uf">UF:</label>
				<input type="text" class="form-control" id="uf" name="customer[state]" maxlength="2" value="<?php echo $customer['state']; ?>">
			</div>

			<div class="form-group col-md-2">
				<label for="ie">Inscrição Estadual:</label>
				<input type="text" class="form-control" id="ie" name="customer[ie]" maxlength="15" value="<?php echo $customer['ie']; ?>">
			</div>
  </div>

  <div id="actions" class="row">
    <div class="col-md-12 mt-2">
      <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
      <a href="index.php" class="btn btn-danger"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>