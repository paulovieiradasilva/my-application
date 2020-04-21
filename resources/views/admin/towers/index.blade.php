@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div style="display: none;" id="buttons"></div>
                <div class="card-body">
                    <div id="loader">Carregando... <img src="{{ asset('img/loaders/loader-grey.gif') }}"></div>
                    <table id="towers_table" class="table table-hover table-sm" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descição</th>
                                <th>Criado</th>
                                <th>Atualizado</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.towers.form')

@endsection

@section('scripts')
<script>
    /** LIST TOWERS */
    $(document).ready(function () {
        $('#towers_table').DataTable({
            initComplete: function () {
                $('#loader').hide();
                $('#towers_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            ajax: "{{ url('towers_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'description' },
                { data: 'created_at' },
                { data: 'updated_at' },
                { data: 'action' }
            ],
            order: [
                [0, 'desc']
            ],
            dom: "<'row'<'col-md-4'B><'col-md-5'l><'col-md-3'f>><'row'<'col-md-12'tr>><'row'<'col-md-3'i><'col-md-3'><'col-md-6'p>>",
            buttons: [{
                    extend: 'pdf',
                    className: 'btn btn-default'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-default'
                },
                {
                    text: 'Novo',
                    action: function () {
                        $('#modalTitle').html('Nova torre');
                        $("#created").html("Cadastrar");
                        $("#updated").hide();
                        $("#created").show();
                        $('#formTower').trigger('reset');
                        $('#modalFormCreate').modal('show');
                    }
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });
    });

    /** RESET MODAL VALIDATIONS */
    $("#modalFormCreate").on("hide.bs.modal", function () {
        $('#id').val('');
        $('#formTower').trigger('reset');
        $('#name').removeClass('is-invalid');
        $('#description').removeClass('is-invalid');
        $('#send').removeClass('save');
        $('#send').removeClass('edit');
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('towers.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formTower').serialize(),
            success: function (data) {
                $('#formTower').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#towers_table').DataTable().ajax.reload(null, false);
                toastr.success(data.success);
            },
            complete: function (data) {},
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.description) {
                    $('#description').addClass('is-invalid');
                    $('#description-feedback').html(data.responseJSON.errors.description);
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('towers.index') }}" + '/' + id + '/edit',
            function (data) {
                $('#modalTitle').html('Editar ambinente');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('towers.index') }}" + "/" + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formTower').serialize(),
            success: function (data) {
                $('#formTower').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#towers_table').DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.description) {
                    $('#description').addClass('is-invalid');
                    $('#description-feedback').html(data.responseJSON.errors.description);
                }
            }
        });

        $('#id').val('');
    }

    /** DELETE  */
    function destroy(id) {

        var id = $('#id').val();

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            url: "{{ route('towers.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                $('#towers_table').DataTable().ajax.reload(null, false);
                $('#deleteModalCenter').modal('hide');
                toastr.success(data.success);
            },
            complete: function (data) {},
            error: function (data) {
                /** Criar as validações dos inputs para erros */
            }
        });

        $('#id').val('');
    }

    /** DELETE CONFIRMATION */
    function confirmation(item) {
        $("#deleteModalCenter").modal("show");
        $("#deleteModalLongTitle").html("Confirmar exclusão");
        $("#id-item").html(item);

        $('#id').val(item);
    }

</script>
@stop
