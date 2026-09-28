		<?php
            include ('functions.php');

            if (!isset($_SESSION)) session_start();

            if (isset($_SESSION['user']) == null) { // Verifica se o usuário está logado

                $_SESSION["message"] = "Você não possui permissão para acessar está página.";
                $_SESSION["type"] = "danger";
                header("Location:" . BASEURL . "index.php");
            
            }
       
            if(isset($_GET["pdf"])){
                if($_GET["pdf"] == "ok" ){
                    pdf();
                } else{
                    pdf($_GET["pdf"]);
                }
            }

            index();
			include HEADER_TEMPLATE;
		?>

		<header class="mb-4 mt-4">
            <h2>Pacientes</h2>
            <div class="mt-2 row mb-2 align-items-center">

                <div class="col-md-6">
                    <form name="filtro" action="index.php" method="post">
                        <div class="input-group">
                            <input type="search" class="form-control" name="pacientes" maxlength="80" required>
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i> Consultar
                            </button>
                            <a class="btn btn-light" href="index.php">
                                <i class="fa-solid fa-refresh"></i> Atualizar
                            </a>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <?php if(isset($_SESSION['user'])) : ?>
			            <?php if($_SESSION['user'] != null) : ?>
                            <a class="btn btn-secondary me-2" href="add.php">
                                <i class="fa-solid fa-user-plus"></i> Novo paciente
                            </a>
                        <?php endif; ?>
		            <?php endif; ?>
              
                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                        <a class="btn btn-dark" href="index.php?pdf=<?php echo  $_POST['pacientes']; ?>" Download> <i class="fa-solid fa-file-pdf"></i>Listagem</a>
                    <?php else :?>
                        <a class="btn btn-dark" href="index.php?pdf=ok" Download> <i class="fa-solid fa-file-pdf"></i>Listagem</a>
                    <?php endif ;?>
                </div>
            </div>
        </header>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php clear_messages(); ?>
        <?php endif; ?>

        <hr>
        <div class="scroll">
            <table class="table table-hover text-center">
                <thead>
                    <tr class="table-active" style="text-align: center;">
                        <th>ID</th>
                        <th width="15%">Nome</th>
                        <th width="15%">Endereço</th>
                        <th width="15%">Idade</th>
                        <th width="15%">Data de Nascimento</th>
                        <th width="15%">Foto</th>
                        <th width="15%">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($pacientes) : ?>
                    <?php foreach ($pacientes as $paciente) : ?>
                        <tr style="text-align: center;">
                            <td><?php echo $paciente['id']; ?></td>
                            <td><?php echo $paciente['nome']; ?></td>
                            <td><?php echo $paciente['endereco']; ?></td>
                            <td><?php echo $paciente['idade']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($paciente['dataNasc']));?></td>
                            <td>
                                <?php 
                                    if (!empty($paciente['foto'])) {
                                        echo "<img src='fotos/" . $paciente['foto'] . "' class='shadow p-1 mb-1 bg-body rounded' width='100px'>";
                                    } else {
                                        echo "<img src='fotos/semimagem.jpg' class='shadow p-1 mb-1 bg-body rounded' width='100px'>";
                                    }
                                ?>
                            </td>
                            <td class="actions text-center">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="view.php?id=<?php echo $paciente['id']; ?>" class="btn btn-sm btn-light me-md-2"><i class="fa fa-eye"></i> Visualizar</a>
                                    <?php if(isset($_SESSION['user'])) : ?>
                                        <?php if($_SESSION['user'] != null) : ?>
                                            <a href="editar.php?id=<?php echo $paciente['id']; ?>" class="btn btn-sm btn-secondary me-md-2"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                            <a href="#" class="btn btn-sm btn-dark me-md-2" data-bs-toggle="modal" data-bs-target="#delete-paciente" data-customer="<?php echo $paciente['id']; ?>">
                                                <i class="fa-solid fa-trash-can"></i> Excluir
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>                                          
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php 
            include "modal.php"; 
            include FOOTER_TEMPLATE;
        ?>
