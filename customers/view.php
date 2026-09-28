<?php 
	include "functions.php"; 
	view($_GET["id"]);
    include HEADER_TEMPLATE; 
?>

<h2>Cliente <?php echo $customer["id"]; ?></h2>
<hr>

<?php if (!empty($_SESSION["message"])) : ?>
	<div class="alert alert-<?php echo $_SESSION["type"]; ?>">
        <?php echo $_SESSION["message"]; ?>
    </div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome / Razão Social:</dt>
	<dd><?php echo $customer["name"]; ?></dd>

	<dt>CPF / CNPJ:</dt>
	<dd><?php echo $customer["cpf_cnpj"]; ?></dd>

	<dt>Data de Nascimento:</dt>
	<dd><?php echo formataData($customer["birthdate"], "d/m/Y"); ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Endereço:</dt>
	<dd><?php echo $customer["address"]; ?></dd>

	<dt>Bairro:</dt>
	<dd><?php echo $customer["hood"]; ?></dd>

	<dt>CEP:</dt>
	<dd><?php echo $customer["zip_code"]; ?></dd>

	<dt>Data de Cadastro:</dt>
    
	<dd><?php echo formataData($customer["created"], "d/m/Y"); ?></dd>

    <dt>Data da última alteração:</dt>
	<dd><?php echo  formataData($customer["modified"], "d/m/Y"); ?></dd>
    
</dl>

<dl class="dl-horizontal">
	<dt>Cidade:</dt>
	<dd><?php echo $customer["city"]; ?></dd>

	<dt>Telefone:</dt>
	<dd><?php echo formataTel($customer["phone"]) ; ?></dd>

	<dt>Celular:</dt>
	<dd><?php echo formataTel($customer["mobile"]) ; ?></dd>

	<dt>UF:</dt>
	<dd><?php echo $customer["state"]; ?></dd>

	<dt>Inscrição Estadual:</dt>
	<dd><?php echo $customer["ie"]; ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
		<?php if (isset($_SESSION['user'])) : ?>
            <?php if ($_SESSION['user'] == "admin1") : ?>
	  			<a href="editar.php?id=<?php echo $customer["id"]; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
        	<?php endif; ?>
        <?php endif; ?>
	  <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-rotate-left"></i> Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>