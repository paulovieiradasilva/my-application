@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="details_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Applicação</th>
                                <th>Ambiente</th>
                                <th>Tipo</th>
                                <th>Conteudo</th>
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

@include('admin.details.form')

@endsection

@section('scripts')
<script>
    /** LIST EMPLOYEES */
    $(document).ready(function () {
        $('#details_table').DataTable({
            initComplete: function () {
                $('.card').show();
                $('#details_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('details_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'application.name' },
                { data: 'environment.name' },
                { data: 'type' },
                { data: 'content' },
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
                    cleanFormDB('#formDetail');
                    $('#id').val('');
                    $('#modalTitle').html('Novo detalhe');
                    $("#created").html("Cadastrar");
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
        getSelectOptions("{{ url('environments-all')}}", "GET", "json", "#select-environments");
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('details.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formDetail').serialize(),
            success: function (data) {
                cleanFormDB('#formDetail');
                $('#modalFormCreate').modal('hide');
                $('#details_table').DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.application_id) {
                    $('#select-applications').addClass('is-invalid');
                    $('#application-feedback').html(data.responseJSON.errors.application_id);
                } else {
                    $('#application').removeClass('is-invalid');
                    $('#application-feedback').val('');
                }
                if (data.responseJSON.errors.environment_id) {
                    $('#select-environments').addClass('is-invalid');
                    $('#environment-feedback').html(data.responseJSON.errors.environment_id);
                } else {
                    $('#environment').removeClass('is-invalid');
                    $('#environment-feedback').val('');
                }
                if (data.responseJSON.errors.type) {
                    $('#type').addClass('is-invalid');
                    $('#type-feedback').html(data.responseJSON.errors.type);
                } else {
                    $('#type').removeClass('is-invalid');
                    $('#type-feedback').val('');
                }
                if (data.responseJSON.errors.content) {
                    $('#content').addClass('is-invalid');
                    $('#content-feedback').html(data.responseJSON.errors.content);
                } else {
                    $('#content').removeClass('is-invalid');
                    $('#content-feedback').val('');
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('details.index') }}" + '/' + id + '/edit',
            function (data) {
                $('#modalTitle').html('Editar detalhe');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#description').val(data.description);
                $('#select-applications').val(data.application_id).trigger('change');
                $('#select-environments').val(data.environment_id).trigger('change');
                $('#type').val(data.type).trigger('change');
                $('#content').val(data.content);
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('details.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formDetail').serialize(),
            success: function (data) {
                cleanFormDB('#formDetail');
                $('#id').val('');
                $('#modalFormCreate').modal('hide');
                $('#details_table').DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.application_id) {
                    $('#select-applications').addClass('is-invalid');
                    $('#application-feedback').html(data.responseJSON.errors.application_id);
                } else {
                    $('#application').removeClass('is-invalid');
                    $('#application-feedback').val('');
                }
                if (data.responseJSON.errors.environment_id) {
                    $('#select-environments').addClass('is-invalid');
                    $('#environment-feedback').html(data.responseJSON.errors.environment_id);
                } else {
                    $('#environment').removeClass('is-invalid');
                    $('#environment-feedback').val('');
                }
                if (data.responseJSON.errors.type) {
                    $('#type').addClass('is-invalid');
                    $('#type-feedback').html(data.responseJSON.errors.type);
                } else {
                    $('#type').removeClass('is-invalid');
                    $('#type-feedback').val('');
                }
                if (data.responseJSON.errors.content) {
                    $('#content').addClass('is-invalid');
                    $('#content-feedback').html(data.responseJSON.errors.content);
                } else {
                    $('#content').removeClass('is-invalid');
                    $('#content-feedback').val('');
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
            url: "{{ route('details.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                $('#id').val('');
                $('#details_table').DataTable().ajax.reload(null, false);
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
