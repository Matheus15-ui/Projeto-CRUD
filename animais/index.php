		<?php
            include ('functions.php');
			include HEADER_TEMPLATE;
        index();
		?>

		<header class="mb-4 mt-4">
            <h2>Pets</h2>
            <div class="mt-2 row mb-2 align-items-center">

                <div class="col-md-6">
                    <form name="filtro" action="index.php" method="post">
                        <div class="input-group">
                            <input type="search" class="form-control" name="pets" maxlength="80" required>
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i> Consultar
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <?php if(isset($_SESSION['user'])) : ?>
			            <?php if($_SESSION['user'] != null) : ?>
                            <a class="btn btn-secondary me-2" href="add.php">
                                <i class="fa-solid fa-user-plus"></i> Novo Pet
                            </a>
                        <?php endif; ?>
		            <?php endif; ?>
                    <a class="btn btn-light" href="index.php">
                        <i class="fa-solid fa-refresh"></i> Atualizar
                    </a>
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
                        <th width="15%">Tipo</th>
                        <th width="15%">Tutor</th>
                        <th width="15%">Data de Nascimento</th>
                        <th width="15%">Atualizado em</th>
                        <th width="15%">Foto</th>
                        <th width="15%">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($pets) : ?>
                    <?php foreach ($pets as $pet) : ?>
                        <tr style="text-align: center;">
                            <td><?php echo $pet['id']; ?></td>
                            <td><?php echo $pet['Nome']; ?></td>
                            <td><?php echo $pet['Tipo']; ?></td>
                            <td><?php echo $pet['Tutor']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($pet['DataNasc']));?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($pet['modified'])); ?></td>
                            <td>
                                <?php 
                                    if (!empty($pet['Foto'])) {
                                        echo "<img src='fotos/" . $pet['Foto'] . "' class='shadow p-1 mb-1 bg-body rounded' width='100px'>";
                                    } else {
                                        echo "<img src='fotos/semimagem.jpg' class='shadow p-1 mb-1 bg-body rounded' width='100px'>";
                                    }
                                ?>
                            </td>
                            <td class="actions text-center">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="view.php?id=<?php echo $pet['id']; ?>" class="btn btn-sm btn-light me-md-2"><i class="fa fa-eye"></i> Visualizar</a>
                                    <?php if(isset($_SESSION['user'])) : ?>
                                        <?php if($_SESSION['user'] != null) : ?>
                                            <a href="editar.php?id=<?php echo $pet['id']; ?>" class="btn btn-sm btn-secondary me-md-2"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                            <a href="#" class="btn btn-sm btn-dark me-md-2" data-bs-toggle="modal" data-bs-target="#delete-pet" data-customer="<?php echo $pet['id']; ?>">
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
