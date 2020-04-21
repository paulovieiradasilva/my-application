<!-- Modal Form -->
<input type="hidden" id="id"></input>
<div class="modal fade" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formRole">
                @csrf
                <div class="modal-body">
                    @include('admin.roles._fields')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button style="display: none;" type="button" onclick="store()" id="created" class="btn btn-primary"></button>
                    <button style="display: none;" type="button" onclick="update()" id="updated" class="btn btn-success"></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Delete-->
<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h5>Deseja realmente excluir o item de ID: <span id="id-item" class="badge badge-warning"></span></h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="destroy()" class="btn btn-success">Confirmar</button>
            </div>
        </div>
    </div>
</div>
