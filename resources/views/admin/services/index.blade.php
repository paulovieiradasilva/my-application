@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="services_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Start</th>
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

@include('admin.services.form')

@endsection

@section('scripts')
<script>
    /** LIST EMPLOYEES */
    $(document).ready(function () {
        $('#services_table').DataTable({
            initComplete: function () {
                $('.card').show();
                $('#services_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('services_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'start' },
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
                    cleanFormDB('#formService');
                    $('#modalTitle').html('Novo serviço');
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

        $.ajax({
            url: "{{ route('services.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formService').serialize(),
            success: function (data) {
                cleanFormDB('#formService');
                $('#modalFormCreate').modal('hide');
                $('#services_table').DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.start) {
                    $('#start').addClass('is-invalid');
                    $('#start-feedback').html(data.responseJSON.errors.start);
                } else {
                    $('#start').removeClass('is-invalid');
                    $('#start-feedback').val('');
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

        $.get(
            "{{ route('services.index') }}" + '/' + id + '/edit',
            function (data) {
                $('#modalTitle').html('Editar serviço');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#name').val(data.name);
                if (data.credential != null) {
                    $('#username').val(data.credential.username);
                    $('#password').val(data.credential.password);
                }
                $('#start').val(data.start).trigger('change');
                $('#description').val(data.description);
                $('#select-applications').val(data.application_id).trigger('change');
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('services.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formService').serialize(),
            success: function (data) {
                cleanFormDB('#formService');
                $('#id').val('');
                $('#modalFormCreate').modal('hide');
                $('#services_table').DataTable().ajax.reload(null, false);
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
            url: "{{ route('services.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                $('#id').val('');
                $('#services_table').DataTable().ajax.reload(null, false);
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
