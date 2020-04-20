@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <div id="loader">Carregando... <img src="{{ asset('img/loaders/103.gif')}}"></div>
                    <table id="servers_table" class="table table-hover table-sm">
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
                                <th></th>
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
    $(document).ready(function () {
        $('#servers_table').DataTable({
            initComplete: function () {
                $('#loader').hide();
            }
            , processing: true
            , serverSide: true
            , ajax: "{{ url('servers_datatables') }}"
            , columns: [{
                data: 'id'
            }
                , {
                data: 'name'
            }
                , {
                data: 'ip'
            }
                , {
                data: 'os'
            }
                , {
                data: 'type'
            }
                , {
                data: 'environment.name'
            }
                , {
                data: 'created_at'
            }
                , {
                data: 'updated_at'
            }
                , {
                data: 'action'
            }
            ]
            , order: [
                [0, 'desc']
            ]
            , dom: "<'row'<'col-md-4'B><'col-md-5'l><'col-md-3'f>><'row'<'col-md-12'tr>><'row'<'col-md-3'i><'col-md-3'><'col-md-6'p>>"
            , buttons: [{
                extend: 'pdf'
                , className: 'btn btn-default'
            }
                , {
                extend: 'excel'
                , className: 'btn btn-default'
            }
                , {
                text: 'Novo'
                , action: function (e, dt, node, config) {
                    $('#id').val(''); // verificar a possiblidade de remoção
                    $('#edit-item-table').hide();
                    $('#add-item-table').show();
                    $('#table').hide();
                    $('#modalTitle').html('Novo servidor');
                    $('#send').html('Cadastrar');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formServer').trigger('reset');
                    $('#modalFormCreate').modal('show');
                }
            }
            ]
            , language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
            ,
        });
    });

    /** RESET MODAL VALIDATIONS */
    $("#modalFormCreate").on("hide.bs.modal", function () {
        cleanFormDB();
        $("#server-table").find("tr:not(:first)").remove();
        $('#formServer').trigger('reset');
        $('#id').val(''); // verificar a possiblidade de remoção
        $('#name').removeClass('is-invalid');
        $('#ip').removeClass('is-invalid');
        $('#os').removeClass('is-invalid');
        $('#type').removeClass('is-invalid');
        $('#send').removeClass('save');
        $('#send').removeClass('edit');
        $('#select-environment').removeClass('is-invalid');
        $('#select-environment').val(null).trigger('change');
    });

    /** CREATE  */
    $(document).on('click', '.save', function (event) {

        event.preventDefault();

        $.ajax({
            url: "{{ route('servers.store') }}"
            , type: 'POST'
            , dataType: 'json'
            , data: $('#formServer').serialize()
            , success: function (data) {
                cleanFormDB();
                $('#id').val(''); // verificar a possiblidade de remoção
                $('#formServer').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#servers_table').DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            }
            , complete: function (data) { }
            , error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').val('');
                }
                if (data.responseJSON.errors.type) {
                    $('#type').addClass('is-invalid');
                    $('#type-feedback').html(data.responseJSON.errors.type);
                } else {
                    $('#type').removeClass('is-invalid');
                    $('#type-feedback').val('');
                }
                if (data.responseJSON.errors.environment_id) {
                    $('#select-environment').addClass('is-invalid');
                    $('#environment-feedback').html(data.responseJSON.errors.environment_id);
                } else {
                    $('#select-environment').removeClass('is-invalid');
                    $('#environment-feedback').val('');
                }
            }
        });
    });

    /** EDIT  */
    $(document).on('click', '#edit-item', function (event) {

        event.preventDefault();

        let id = $(this).data('id');

        $('#edit-item-table').show();
        $('#add-item-table').hide();
        $('#send').removeClass('save');
        $('#send').addClass('edit');

        $.get("{{ route('servers.index') }}" + '/' + id + '/edit', function (data) {

            /** */
            data.data.databases.forEach(function (item) {
                addRowTable('#server-table', item);
            })

            $('#modalTitle').html('Editar servidor');
            $('#send').html('Atualizar');
            $('#modalFormCreate').modal('show');
            $('#id').val(data.data.server.id); // verificar a possiblidade de remoção
            $('#name').val(data.data.server.name);
            $('#ip').val(data.data.server.ip);
            $('#os').val(data.data.server.os);
            if (data.data.server.credential != null) {
                $('#username').val(data.data.server.credential.username);
                $('#password').val(data.data.server.credential.password);
            }
            $('#type').val(data.data.server.type);
            (data.data.server.type == 'database') ? $('#table').show() : $('#table').hide();
            $('#select-environment').val(data.data.server.environment_id).trigger('change');
            $('#description').val(data.data.server.description);
        });

        /** SEND FORM UPDATE */
        $('.edit').unbind().bind('click', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('servers.index') }}" + '/' + id
                , type: 'PATCH'
                , dataType: 'json'
                , data: $('#formServer').serialize()
                , success: function (data) {
                    $('#id').val(''); // verificar a possiblidade de remoção
                    $('#formServer').trigger('reset');
                    $('#modalFormCreate').modal('hide');
                    $('#servers_table').DataTable().ajax.reload(null, false);
                    if (data.success) {
                        toastr.success(data.success);
                    }
                    if (data.error) {
                        toastr.error(data.error);
                    }
                }
                , complete: function (data) { }
                , error: function (data) {
                    /** Criar as validações dos inputs para erros */
                    if (data.responseJSON.errors.name) {
                        $('#name').addClass('is-invalid');
                        $('#name-feedback').html(data.responseJSON.errors.name);
                    }
                    if (data.responseJSON.errors.environment_id) {
                        $('#select-environment').addClass('is-invalid');
                        $('#environment-feedback').html(data.responseJSON.errors.environment_id);
                    }
                }
            });

        });
    });

    /** DELETE  */
    $(document).on('click', '#delete-item', function (event) {

        event.preventDefault();

        let id = $(this).data('id');

        $('#deleteModalCenter').modal('show');
        $('#deleteModalLongTitle').html('Confirmar exclusão');
        $('#id-item').html(id);

        /** SEND FORM DELETE */
        $('#send-delete').unbind().bind('click', function (event) {

            event.preventDefault();

            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}"
                    , "id": id
                }
                , url: "{{ route('servers.index') }}" + '/' + id
                , type: 'DELETE'
                , dataType: 'json'
                , success: function (data) {
                    $('#id').val(''); // verificar a possiblidade de remoção
                    $('#servers_table').DataTable().ajax.reload(null, false);
                    $('#deleteModalCenter').modal('hide');
                    if (data.success) {
                        toastr.success(data.success);
                    }
                    if (data.error) {
                        toastr.error(data.error);
                    }
                }
                , complete: function (data) { }
                , error: function (data) {
                    /** Criar as validações dos inputs para erros */
                }
            });
        });
    });

    /** LIST PERMISSIONS */
    $(document).ready(function () {
        $.ajax({
            url: "{{ url('environments') }}"
            , type: "GET"
            , dataType: "json"
            , success: function (data) {
                $.each(data, function (i, d) {
                    $('#select-environment').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            }
        })
    });

    /** CHANGE TYPE SERVER */
    $(document).on('change', '#type', function () {
        var item = $('#type').val();
        (item == 'database') ? $('#table').show() : $('#table').hide();
    });

    /** VALIDATION AND ADD NEW INF DATABASE TO TABLE*/
    $(document).on('click', '#add-item-table', function (event) {

        event.preventDefault();

        if ($('#dbn').val() == '' || $('#sgdb').val() == '' || $('#port').val() == '' || $('#usr').val() == '' || $('#pwd').val() == '') {

            $('#error-msg').show();

            ($('#dbn').val() == '') ? $('#dbn').addClass('is-invalid') : $('#dbn').removeClass('is-invalid');
            ($('#sgdb').val() == '') ? $('#sgdb').addClass('is-invalid') : $('#sgdb').removeClass('is-invalid');
            ($('#port').val() == '') ? $('#port').addClass('is-invalid') : $('#port').removeClass('is-invalid');
            ($('#usr').val() == '') ? $('#usr').addClass('is-invalid') : $('#usr').removeClass('is-invalid');
            ($('#pwd').val() == '') ? $('#pwd').addClass('is-invalid') : $('#pwd').removeClass('is-invalid');

        } else {

            var id;
            var name = $('#dbn').val();
            var sgdb = $('#sgdb').val();
            var port = $('#port').val();
            var username = $('#usr').val();
            var password = $('#pwd').val();

            var data = { data: { id, name, sgdb, port, credential: { username, password } } };

            console.log(data);

            /** */
            addRowTable('#server-table', data.data, null);

            cleanFormDB();
        }
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** ADD ITEM DATABASE AND TABLE*/
    function addItem() {

        var name = $('#dbn').val();
        var sgdb = $('#sgdb').val();
        var port = $('#port').val();
        var username = $('#usr').val();
        var password = $('#pwd').val();
        let server_id = $('#id').val(); // verificar a possiblidade de remoção

        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
                , "name": name
                , "sgdb": sgdb
                , "port": port
                , "username": username
                , "password": password
                , "server_id": server_id
            }
            , url: "{{ route('database.store') }}"
            , type: 'POST'
            , dataType: 'json'
            , success: function (data) {

                console.log(data);

                cleanFormDB();

                /** */
                addRowTable('#server-table', data.data);

                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            }
            , complete: function (data) { }
            , error: function (data) {
                /** Criar as validações dos inputs para erros */
            }
        });
    }

    /** UPDATE ITEM DATABASE AND TABLE*/
    function updateItem(id) {
        var name = $('#name_' + id).val();
        var sgdb = $('#sgdb_' + id).val();
        var port = $('#port_' + id).val();
        var username = $('#username_' + id).val();
        var password = $('#password_' + id).val();
        var server_id = $('#id').val();

        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
                , "name": name
                , "sgdb": sgdb
                , "port": port
                , "username": username
                , "password": password
                , "server_id": server_id
            }
            , url: "{{ url('database') }}" + '/' + id
            , type: 'PATCH'
            , dataType: 'json'
            , success: function (data) {

                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            }
            , complete: function (data) { }
            , error: function (data) {
                /** Criar as validações dos inputs para erros */
            }
        });
    }

    /** REMOVE ITEM TABLE AND DATABASE */
    function removeItem(id) {

        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , url: "{{ url('database') }}" + '/' + id
            , type: 'DELETE'
            , dataType: 'json'
            , success: function (data) {
                $("#row-" + id).remove();
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            }
            , complete: function (data) { }
            , error: function (data) {
                /** Criar as validações dos inputs para erros */
            }
        });

    }

    /** CLEAN FORM DB */
    function cleanFormDB() {
        $('#error-msg').hide();
        $('#dbn').removeClass('is-invalid').val('');
        $('#sgdb').removeClass('is-invalid').val('');
        $('#port').removeClass('is-invalid').val('');
        $('#usr').removeClass('is-invalid').val('');
        $('#pwd').removeClass('is-invalid').val('');
    }

    /** RETURN NEW TR TO TABLE */
    function addRowTable(selector, data, index = null) {

        newRow = $(selector).find('tbody').append(`
            <tr id="row-${data.id}">
                <td><input class="form-control form-control-sm" id="name_${data.id}" type="text" name="db[]" value="${data.name}"></td>
                <td><input class="form-control form-control-sm" id="sgdb_${data.id}" type="text" name="sgdb[]" value="${data.sgdb}"></td>
                <td><input class="form-control form-control-sm" id="port_${data.id}" type="text" name="port[]" value="${data.port}"></td>
                <td><input class="form-control form-control-sm" id="username_${data.id}" type="text" name="usr[]" value="${data.credential.username}"></td>
                <td><input class="form-control form-control-sm" id="password_${data.id}" type="text" name="pwd[]" value="${data.credential.password}"></td>
                <td>
                    <a href="#" title="Update" id="update-item-databases" onclick="updateItem(${data.id})" class="btn btn-primary btn-xs">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                    <a href="#" title="Delete" id="delete-item-databases" onclick="removeItem(${data.id})" class="btn btn-danger btn-xs">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        `);

        /** */
        (data.id === undefined) ? $('#update-item-databases').addClass('disabled') : '';

        return newRow;
    }

</script>
@stop