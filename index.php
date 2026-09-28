<?php 
    include "config.php"; 
    include DBAPI;
	if (!isset($_SESSION)) session_start();
    $db = open_database();
	include(HEADER_TEMPLATE); 
?>
<br><br>
<h1>Início</h1>
<hr>

<?php if ($db) : ?>

	<!-- donos-->
	<div class="row mt-2">
		<?php if(isset($_SESSION['user'])) : ?>
			<?php if($_SESSION['user'] != null) : ?>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<a href="customers/add.php" class="btn btn-light btn-lg btn-block">
						<div class="row">
							<div class="col-xs-12 text-center">
								<!--<i class="fa fa-plus fa-5x"></i>-->
								<i class="fa-solid fa-user-plus fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Novo dono</p>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
			<a href="customers" class="btn btn-secondary btn-lg btn-block">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Donos</p>
					</div>
				</div>
			</a>
		</div>
	</div>
	<!--pets -->
	<div class="row mt-2">
		<?php if(isset($_SESSION['user'])) : ?>
			<?php if($_SESSION['user'] != null) : ?>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<a href="animais/add.php" class="btn btn-light btn-lg btn-block">
						<div class="row">
							<div class="col-xs-12 text-center">
								<!--<i class="fa fa-plus fa-5x"></i>-->
								<i class="fa-solid fa-shield-dog fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Novo Pet</p>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
			<a href="animais" class="btn btn-secondary btn-lg btn-block">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa-solid fa-paw fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Pets</p>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="row mt-2">
		<?php if(isset($_SESSION['user'])) : ?>
			<?php if($_SESSION['user'] == "admin1") : ?>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<a href="usuarios/add.php" class="btn btn-light btn-lg btn-block">
						<div class="row">
							<div class="col-xs-12 text-center">
								<!--<i class="fa fa-plus fa-5x"></i>-->
								<i class="fa-solid fa-user-tie fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Novo Usuario</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<a href="usuarios" class="btn btn-secondary btn-lg btn-block">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa fa-users-gear fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Usuario</p>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<!-- pacientes -->
	<div class="row mt-2">
		<?php if(isset($_SESSION['user'])) : ?>
			<?php if($_SESSION['user'] != null) : ?>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<a href="pacientes/add.php" class="btn btn-light btn-lg btn-block">
						<div class="row">
							<div class="col-xs-12 text-center">
								<!--<i class="fa fa-plus fa-5x"></i>-->
								<i class="fa-solid fa-file-medical fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Novo paciente</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<a href="pacientes" class="btn btn-secondary btn-lg btn-block">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa-solid fa-star-of-life fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>pacientes</p>
							</div>
						</div>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php else : ?>
    <!--
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div> -->
	<?php if (!empty($_SESSION['message'])) : ?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
			<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
			<?php echo $_SESSION['message']; ?></p>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php clear_messages(); ?>
		<?php endif; ?>
	<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>