<div class="modal fade" id="modalEditarResultados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Resultados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formActualizaResultados" method="POST">@csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="result_id" name="result_id" readonly hidden>
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control form-control-sm" id="edit_title" name="edit_title"  required>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Descripción de Resultado</label>
                            <textarea name="edit_description" id="edit_description" class="form-control form-control-sm"  required></textarea>
                        </div>
                        
                    </div>
                    <br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Salir</button>
                    <button type="button" onclick="btnActualizarResultados(event)" class="btn btn-primary btn-sm">Guardar</a>
                </div>

            </form>
        </div>
    </div>
</div>