<div class="modal fade" id="modalAgregarResultados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Resultados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formResultados" method="POST">@csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" id="result_test_id" name="result_test_id" readonly hidden>
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control form-control-sm" id="title" name="title"  required>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Descripción de Resultado</label>
                            <textarea name="description" id="description" class="form-control form-control-sm"  required></textarea>
                        </div>
                        
                    </div>
                    <br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Salir</button>
                    <button type="button" onclick="btnRegistrarResultados(event)" class="btn btn-primary btn-sm">Guardar</a>
                </div>

            </form>
        </div>
    </div>
</div>