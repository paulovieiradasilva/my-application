<!-- Modal Form -->
<input type="hidden" id="id"></input>
<div class="modal fade bd-example-modal-lg" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formDatabase">
                @csrf
                <div class="modal-body">
                    @include('admin.databases._fields')
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
@include('components.modal.delete')
