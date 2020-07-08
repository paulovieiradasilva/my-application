@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="databases_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>SGDB</th>
                                <th>Porta</th>
                                <th>Nome do Servidor</th>
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

@include('admin.databases.form')

@endsection

@section('scripts')
<script>
    /** LIST SERVERS */
    $(document).ready(function() {
        $('#databases_table').DataTable({
            initComplete: function() {
                $('.card').show();
                $('#databases_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('databases_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'sgdb' },
                { data: 'port' },
                { data: 'server.name' },
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
                    cleanFormDB('#formDatabase');
                    $('#modalTitle').html('Novo banco de dados');
                    $("#created").html("Cadastrar");
                    $("#updated").hide();
                    $("#created").show();
                    $('#formDatabase').trigger('reset');
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
        getSelectOptions("{{ url('servers-all')}}", "GET", "json", "#select-servers");
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('databases.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formDatabase').serialize(),
            success: function(data) {
                cleanFormDB('#formDatabase');
                $('#modalFormCreate').modal('hide');
                $('#databases_table').DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.server_id) {
                    $('#select-servers').addClass('is-invalid');
                    $('#server-feedback').html(data.responseJSON.errors.server_id);
                } else {
                    $('#select-servers').removeClass('is-invalid');
                    $('#server-feedback').val('');
                }
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').val('');
                }
                if (data.responseJSON.errors.sgdb) {
                    $('#sgdb').addClass('is-invalid');
                    $('#sgdb-feedback').html(data.responseJSON.errors.sgdb);
                } else {
                    $('#sgdb').removeClass('is-invalid');
                    $('#sgdb-feedback').val('');
                }
                if (data.responseJSON.errors.port) {
                    $('#port').addClass('is-invalid');
                    $('#port-feedback').html(data.responseJSON.errors.port);
                } else {
                    $('#port').removeClass('is-invalid');
                    $('#port-feedback').val('');
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
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('databases.index') }}" + '/' + id + '/edit',
            function(data) {
                $('#edit-item-table').show();
                $('#add-item-table').hide();
                $('#modalTitle').html('Editar banco de dados');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');

                $('#name').val(data.data.databases.name);
                $('#sgdb').val(data.data.databases.sgdb);
                $('#port').val(data.data.databases.port);
                if (data.data.databases.credential != null) {
                    $('#username').val(data.data.databases.credential.username);
                    $('#password').val(data.data.databases.credential.password);
                }
                $('#select-servers').val(data.data.databases.server_id).trigger('change');
                $('#id').val(data.data.databases.id);
            });
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('databases.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formDatabase').serialize(),
            success: function(data) {
                cleanFormDB('#formDatabase');
                $('#id').val('');
                $('#formDatabase').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#databases_table').DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.server_id) {
                    $('#select-servers').addClass('is-invalid');
                    $('#server-feedback').html(data.responseJSON.errors.server_id);
                } else {
                    $('#select-servers').removeClass('is-invalid');
                    $('#server-feedback').val('');
                }
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').val('');
                }
                if (data.responseJSON.errors.sgdb) {
                    $('#sgdb').addClass('is-invalid');
                    $('#sgdb-feedback').html(data.responseJSON.errors.sgdb);
                } else {
                    $('#sgdb').removeClass('is-invalid');
                    $('#sgdb-feedback').val('');
                }
                if (data.responseJSON.errors.port) {
                    $('#port').addClass('is-invalid');
                    $('#port-feedback').html(data.responseJSON.errors.port);
                } else {
                    $('#port').removeClass('is-invalid');
                    $('#port-feedback').val('');
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
            url: "{{ route('databases.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(data) {
                $('#id').val('');
                $('#databases_table').DataTable().ajax.reload(null, false);
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