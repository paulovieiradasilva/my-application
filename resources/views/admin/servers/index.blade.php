@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <div id="loader">Carregando...<img src="{{ asset('img/loaders/loader-grey.gif') }}"></div>
                    <table id="servers_table" class="table table-hover table-sm" style="display: none;">
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
    /** LIST SERVERS */
    $(document).ready(function() {
        $('#servers_table').DataTable({
            initComplete: function() {
                $('#loader').hide();
                $('#servers_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
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
                action: function(e, dt, node, config) {
                    $('#edit-item-table').hide();
                    $('#add-item-table').show();
                    $('#table').hide();
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

    /** LIST PERMISSIONS */
    $(document).ready(function() {
        $.ajax({
            url: "{{ url('environments') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, d) {
                    $('#select-environment').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            }
        })
    });

    /** CHANGE TYPE SERVER */
    $(document).on('change', '#type', function() {
        var item = $('#type').val();
        (item == 'database') ? $('#table').show(): $('#table').hide();
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
                cleanFormDB();
                $('#formServer').trigger('reset');
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
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('servers.index') }}" + '/' + id + '/edit',
            function(data) {

                /** */
                data.data.databases.forEach(function(item) {
                    addRowTable('#server-table', item);
                })

                $('#edit-item-table').show();
                $('#add-item-table').hide();
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
                $('#type').val(data.data.server.type);
                (data.data.server.type == 'database') ? $('#table').show(): $('#table').hide();
                $('#select-environment').val(data.data.server.environment_id).trigger('change');
                $('#description').val(data.data.server.description);
                $('#id').val(data.data.server.id);
            });
    }

    /** UPDATE */
    function update(id) {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('servers.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formServer').serialize(),
            success: function(data) {
                $('#formServer').trigger('reset');
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
                }
                if (data.responseJSON.errors.environment_id) {
                    $('#select-environment').addClass('is-invalid');
                    $('#environment-feedback').html(data.responseJSON.errors.environment_id);
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
            url: "{{ route('servers.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(data) {
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

        $('#id').val('');
    }

    /** DELETE CONFIRMATION */
    function confirmation(item) {
        $("#deleteModalCenter").modal("show");
        $("#deleteModalLongTitle").html("Confirmar exclusão");
        $("#id-item").html(item);

        $('#id').val(item);
    }

    /** VALIDATE */
    function validate(selector) {

        var inputs = new Array();
        var count = 0;

        $('input[name='+selector+']').each(function(){

            var value = $(this).val();
            if (value) {
                inputs.push(value);
            }
            count++;
            
        });

        return (inputs.length == count) ? true : false;

    }

    /** ADD ITEM TO TABLE */
    function addItemToTable() {

        var result = validate('is-empty');

        if (result) {

            var $i = Math.floor((Math.random() * 100) + 1);
            var id;
            var name = $('#dbn').val();
            var sgdb = $('#sgdb').val();
            var port = $('#port').val();
            var username = $('#usr').val();
            var password = $('#pwd').val();

            var data = { data: { id, name, sgdb, port, credential: { username, password }}};

            /** */
            addRowTable('#server-table', data.data, $i);

            cleanFormDB('is-empty','is-invalid');

        } else {
            $('#error-msg').show();
        }

    }

    /** ADD ITEM DATABASE AND TABLE*/
    function addItem() {

        var result = validate('is-empty');

        if (result) {

            var name = $('#dbn').val();
            var sgdb = $('#sgdb').val();
            var port = $('#port').val();
            var username = $('#usr').val();
            var password = $('#pwd').val();
            let server_id = $('#id').val();

            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
                    "sgdb": sgdb,
                    "port": port,
                    "username": username,
                    "password": password,
                    "server_id": server_id
                },
                url: "{{ route('database.store') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    cleanFormDB();

                    /** */
                    addRowTable('#server-table', data.data);

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

        } else {
            $('#error-msg').show();
        }

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
                "_token": "{{ csrf_token() }}",
                "name": name,
                "sgdb": sgdb,
                "port": port,
                "username": username,
                "password": password,
                "server_id": server_id
            },
            url: "{{ url('database') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            success: function(data) {

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

    /** REMOVE ITEM TABLE AND DATABASE */
    function removeItem(id, index) {

        if (id != undefined) {
            $.ajax({
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                url: "{{ url('database') }}" + '/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function(data) {
                    $("#row-" + index).remove();
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
        } else {
            $("#row-" + index).remove();
        }

    }

    /** CLEAN FORM DB */
    function cleanFormDB(selector, cls) {

        $('#error-msg').hide();

        $('#dbn').val('');
        $('#sgdb').val('');
        $('#port').val('');
        $('#usr').val('');
        $('#pwd').val('');

        $('input[name='+selector+']').each(function(){
            $('input[name='+selector+']').removeClass(cls);
        });

    }

    /** RETURN NEW TR TO TABLE */
    function addRowTable(selector, data, index = null) {

        newRow = $(selector).find('tbody').append(`
            <tr id="row-${index}">
                <td><input class="form-control form-control-sm" id="name_${data.id}" type="text" name="db[]" value="${data.name}"></td>
                <td><input class="form-control form-control-sm" id="sgdb_${data.id}" type="text" name="sgdb[]" value="${data.sgdb}"></td>
                <td><input class="form-control form-control-sm" id="port_${data.id}" type="text" name="port[]" value="${data.port}"></td>
                <td><input class="form-control form-control-sm" id="username_${data.id}" type="text" name="usr[]" value="${data.credential.username}"></td>
                <td><input class="form-control form-control-sm" id="password_${data.id}" type="text" name="pwd[]" value="${data.credential.password}"></td>
                <td>
                    <a href="#" title="Update" onclick="updateItem(${data.id})" class="btn btn-primary btn-xs update-item-databases">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                    <a href="#" title="Delete" onclick="removeItem(${data.id},${index})" class="btn btn-danger btn-xs">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        `
        );

        /** */
        (data.id === undefined) ? $('.update-item-databases').addClass('disabled'): '';

        return newRow;
    }

</script>
@stop