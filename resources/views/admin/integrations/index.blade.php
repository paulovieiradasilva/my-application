@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="integrations_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Applicação</th>
                                <th>Descrição</th>
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

@include('admin.integrations.form')

@endsection

@section('scripts')
<script>
    /** LIST EMPLOYEES */
    $(document).ready(function () {
        $('#integrations_table').DataTable({
            initComplete: function () {
                $('.card').show();
                $('#integrations_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('integrations_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'type' },
                { data: 'application.name' },
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
            }, {
                extend: 'excel',
                className: 'btn btn-default'
            }, {
                text: 'Novo',
                action: function () {
                    cleanFormDB('#formIntegration');
                    $('#modalTitle').html('Nova integração');
                    /** */
                    removeSpinner("#created", 'Cadastrar');
                    $("#updated").hide();
                    $("#created").show();
                    $('#modalFormCreate').modal('show');
                }
            }],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });
    });

    /** RESET MODAL VALIDATIONS */
    $("#modalFormCreate").on("hide.bs.modal", function () {
    });

    /** LIST ALL */
    $(document).ready(function () {
        getSelectOptions("{{ url('applications-all')}}", "GET", "json", "#select-applications");
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        /** */
        addSpinner("#created", true);

        $.ajax({
            url: "{{ route('integrations.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formIntegration').serialize(),
            success: function (data) {
                cleanFormDB('#formIntegration');
                $('#modalFormCreate').modal('hide');
                $('#integrations_table').DataTable().ajax.reload(null, false);
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
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').val('');
                }
                if (data.responseJSON.errors.username) {
                    $('#username').addClass('is-invalid');
                    $('#username-feedback').html(data.responseJSON.errors.username);
                } else {
                    $('#username').removeClass('is-invalid');
                    $('#username-feedback').val('');
                }
                if (data.responseJSON.errors.password) {
                    $('#password').addClass('is-invalid');
                    $('#password-feedback').html(data.responseJSON.errors.password);
                } else {
                    $('#password').removeClass('is-invalid');
                    $('#password-feedback').val('');
                }
                if (data.responseJSON.errors.type) {
                    $('#type').addClass('is-invalid');
                    $('#type-feedback').html(data.responseJSON.errors.type);
                } else {
                    $('#type').removeClass('is-invalid');
                    $('#type-feedback').val('');
                }
                if (data.responseJSON.errors.application_id) {
                    $('#select-applications').addClass('is-invalid');
                    $('#application-feedback').html(data.responseJSON.errors.application_id);
                } else {
                    $('#application').removeClass('is-invalid');
                    $('#application-feedback').val('');
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        cleanFormDB('#formIntegration');

        $.get(
            "{{ route('integrations.index') }}" + '/' + id + '/edit',
            function (data) {
                $('#modalTitle').html('Editar integração');
                /** */
                removeSpinner("#updated", 'Atualizar');
                $('#modalFormCreate').modal('show');
                $('#name').val(data.name);
                if (data.credential != null) {
                    $('#username').val(data.credential.username);
                    $('#password').val(data.credential.password);
                }
                $('#type').val(data.type).trigger('change');
                $('#description').val(data.description);
                $('#select-applications').val(data.application_id).trigger('change');
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
            url: "{{ route('integrations.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formIntegration').serialize(),
            success: function (data) {
                cleanFormDB('#formIntegration');
                $('#id').val('');
                $('#modalFormCreate').modal('hide');
                $('#integrations_table').DataTable().ajax.reload(null, false);
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
            }
        });
    }

    /** DELETE  */
    function destroy() {

        var id = $('#id').val();

        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            url: "{{ route('integrations.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                $('#id').val('');
                $('#integrations_table').DataTable().ajax.reload(null, false);
                $('#deleteModalCenter').modal('hide');
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
