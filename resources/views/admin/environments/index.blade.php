@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="environments_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descição</th>
                                <th>Criado</th>
                                <th>Atualizado</th>
                                <th class="myWidth"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.environments.form')

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#environments_table').DataTable({
            initComplete: function () {
                $('.card').show();
                $('#environments_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('environments_datatables') }}",
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
                        cleanFormDB('#formEnvironment');
                        $('#modalTitle').html('Novo ambiente');
                        /** */
                        removeSpinner("#created", 'Cadastrar');
                        $("#updated").hide();
                        $("#created").show();
                        $('#modalFormCreate').modal('show');
                    }
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });

        /** RESET MODAL VALIDATIONS */
        $("#modalFormCreate").on("hide.bs.modal", function () {
        });

    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        /** */
        addSpinner("#created", true);

        $.ajax({
            url: "{{ route('environments.store') }}",
            type: "POST",
            dataType: "json",
            data: $("#formEnvironment").serialize(),
            success: function (data) {
                cleanFormDB('#formEnvironment');
                $("#modalFormCreate").modal("hide");
                $("#environments_table").DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {

                /** */
                removeSpinner("#created", 'Cadastrar');

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

    /** EDIT */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        cleanFormDB('#formEnvironment');

        $.get(
            "{{ route('environments.index') }}" + "/" + id + "/edit",
            function (data) {
                $('#modalTitle').html('Editar ambinente');
                /** */
                removeSpinner("#updated", 'Atualizar');
                $('#modalFormCreate').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        /** */
        addSpinner("#updated", true);

        $.ajax({
            url: "{{ route('environments.index') }}" + "/" + id,
            type: "PATCH",
            dataType: "json",
            data: $("#formEnvironment").serialize(),
            success: function (data) {
                cleanFormDB('#formEnvironment');
                $('#id').val('');
                $("#modalFormCreate").modal("hide");
                $("#environments_table")
                    .DataTable()
                    .ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {

                /** */
                removeSpinner("#updated", 'Atualizar');

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

    /** DELETE */
    function destroy(id) {

        var id = $('#id').val();

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            url: "{{ route('environments.index') }}" + "/" + id,
            type: "DELETE",
            dataType: "json",
            success: function (data) {
                $('#id').val('');
                $("#environments_table").DataTable().ajax.reload(null, false);
                $("#deleteModalCenter").modal("hide");
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
            }
        });
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
