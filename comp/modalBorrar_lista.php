<div class="modal fade" id="modal_borrarlista" tabindex="-1" aria-labelledby="modal_borrar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="exampleModalLabel">¿Está seguro que desea eliminar estos registros?</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="borrarlista.php" method="post">
          <div class="modal-footer">            
            <button type="submit" name="borrarlista_submit" class="btn btn-dark">Si</button>
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">No</button>
          </div>