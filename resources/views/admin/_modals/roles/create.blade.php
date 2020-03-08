<!-- Button trigger modal -->
<button hidden id="my-modal-show" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#exampleModalCenter">
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Novo papél</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @include('admin._modals.roles._fields')
            </div>
            <div class="modal-footer">
                <button type="button" id="save-role" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>