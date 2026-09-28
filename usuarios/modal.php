<!-- Modal -->
<div class="modal fade" id="delete-usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir Usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este usuário
      </div>
      <div class="modal-footer">
        <a id="confirm" class="btn btn-secondary" href="#"><i class="fa-solid fa-circle-check"></i> Sim</a>
        <a id="cancel" class="btn btn-light" data-bs-dismiss="modal" href="#"><i class="fa-solid fa-circle-xmark"></i> Não</a>
      </div>
    </div>
  </div>
</div>

<script>
  // Atualiza o link do botão "Sim" com o ID do usuário clicado
  const deleteModal = document.getElementById('delete-usuario');
  deleteModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const userId = button.getAttribute('data-customer');
    const confirmLink = deleteModal.querySelector('#confirm');
    confirmLink.href = 'delete.php?id=' + userId;
  });
</script>
