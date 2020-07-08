@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="servers_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>IP</th>
                                <th>Sistema Operacional</th>
                                <th>Tipo</th>
                                <th>Ambiente</th>
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

@include('admin.servers.form')

@endsection

@section('scripts')
<script>
    /** LIST SERVERS */
    $(document).ready(function() {
        $('#servers_table').DataTable({
            initComplete: function() {
                $('.card').show();
                $('#servers_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('servers_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'ip' },
                { data: 'os' },
                { data: 'type' },
                { data: 'environment.name' },
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
                action: function() {
                    cleanFormDB('#formServer');
                    $('#modalTitle').html('Novo servidor');
                    $("#created").html("Cadastrar");
                    $("#updated").hide();
                    $("#created").show();
                    $('#formServer').trigger('reset');
                    $('#modalFormCreate').modal('show');
                }
            }],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });
    });

    /** RESET MODAL VALIDATIONS */
    $("#modalFormCreate").on("hide.bs.modal", function() {
    });

    /** LIST ALL */
    $(document).ready(function() {
        getSelectOptions("{{ url('environments-all')}}", "GET", "json", "#select-environments");
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('servers.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formServer').serialize(),
            success: function(data) {
                cleanFormDB('#formServer');
                $('#modalFormCreate').modal('hide');
                $('#servers_table').DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function(data) {},
            error: function(data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').val('');
                }
                if (data.responseJSON.errors.id) {
                    $('#id').addClass('is-invalid');
                    $('#id-feedback').html(data.responseJSON.errors.id);
                } else {
                    $('#id').removeClass('is-invalid');
                    $('#id-feedback').val('');
                }
                if (data.responseJSON.errors.os) {
                    $('#os').addClass('is-invalid');
                    $('#os-feedback').html(data.responseJSON.errors.os);
                } else {
                    $('#os').removeClass('is-invalid');
                    $('#os-feedback').val('');
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
                if (data.responseJSON.errors.environment_id) {
                    $('#select-environments').addClass('is-invalid');
                    $('#environment-feedback').html(data.responseJSON.errors.environment_id);
                } else {
                    $('#select-environments').removeClass('is-invalid');
                    $('#environment-feedback').val('');
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('servers.index') }}" + '/' + id + '/edit',
            function(data) {
                $('#modalTitle').html('Editar servidor');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#name').val(data.data.server.name);
                $('#ip').val(data.data.server.ip);
                $('#os').val(data.data.server.os);
                if (data.data.server.credential != null) {
                    $('#username').val(data.data.server.credential.username);
                    $('#password').val(data.data.server.credential.password);
                }
                $('#type').val(data.data.server.type).trigger('change');
                $('#select-environments').val(data.data.server.environment_id).trigger('change');
                $('#description').val(data.data.server.description);
                $('#id').val(data.data.server.id);
            });
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('servers.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formServer').serialize(),
            success: function(data) {
                $('#id').val('');
                cleanFormDB('#formServer');
                $('#modalFormCreate').modal('hide');
                $('#servers_table').DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function(data) {},
            error: function(data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').val('');
                }
                if (data.responseJSON.errors.id) {
                    $('#id').addClass('is-invalid');
                    $('#id-feedback').html(data.responseJSON.errors.id);
                } else {
                    $('#id').removeClass('is-invalid');
                    $('#id-feedback').val('');
                }
                if (data.responseJSON.errors.os) {
                    $('#os').addClass('is-invalid');
                    $('#os-feedback').html(data.responseJSON.errors.os);
                } else {
                    $('#os').removeClass('is-invalid');
                    $('#os-feedback').val('');
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
                if (data.responseJSON.errors.environment_id) {
                    $('#select-environments').addClass('is-invalid');
                    $('#environment-feedback').html(data.responseJSON.errors.environment_id);
                } else {
                    $('#select-environments').removeClass('is-invalid');
                    $('#environment-feedback').val('');
                }
            }
        });
    }

    /** DELETE  */
    function destroy(id) {

        var id = $('#id').val();

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            url: "{{ route('servers.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(data) {
                $('#id').val('');
                $('#servers_table').DataTable().ajax.reload(null, false);
                $('#deleteModalCenter').modal('hide');
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function(data) {},
            error: function(data) {
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