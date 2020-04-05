@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <table id="servers_table" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>IP</th>
                                <th>Sistema Operacional</th>
                                <th>Tipo</th>
                                <th>Ambiente</th>
                                <th>Descrição</th>
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
                { data: 'description' },
                { data: 'created_at' },
                { data: 'updated_at' },
                { data: 'action' }
            ],
            order: [[0, 'desc']],
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
                action: function (e, dt, node, config) {
                    $('#id').val('');
                    $('#modalTitle').html('Novo servidor');
                    $('#send').html('Cadastrar');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formServer').trigger('reset');
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
        $('#formServer').trigger('reset');
        $('#name').removeClass('is-invalid');
        $('#ip').removeClass('is-invalid');
        $('#os').removeClass('is-invalid');
        $('#version_os').removeClass('is-invalid');
        $('#type').removeClass('is-invalid');
        $('#send').removeClass('save');
        $('#send').removeClass('edit');
        $('#select-environment').removeClass('is-invalid');
        $('#select-environment').val(null).trigger('change');
    });

    /** LIST PERMISSIONS */
    $(document).ready(function () {
        $.ajax({
            url: "{{ url('environments') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log(data);

                $.each(data, function (i, d) {
                    $('#select-environment').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            }
        })
    });

    /** CREATE  */
    $(document).on('click', '.save', function (event) {

        event.preventDefault();

        $.ajax({
            url: "{{ route('servers.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formServer').serialize(),
            success: function (data) {
                $('#id').val('');
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
            complete: function (data) {
            },
            error: function (data) {
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

    /** EDIT  */
    $(document).on('click', '#edit-item', function (event) {

        event.preventDefault();

        let id = $(this).data('id');

        $('#send').removeClass('save');
        $('#send').addClass('edit');

        $.get("{{ route('servers.index') }}" + '/' + id + '/edit', function (data) {

            $('#modalTitle').html('Editar servidor');
            $('#send').html('Atualizar');
            $('#modalFormCreate').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#ip').val(data.ip);
            $('#os').val(data.os);
            $('#version_os').val(data.version_os);
            $('#type').val(data.type);
            $('#select-environment').val(data.environment_id).trigger('change');
        });

        /** SEND FORM UPDATE */
        $('.edit').unbind().bind('click', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('servers.index') }}" + '/' + id,
                type: 'PATCH',
                dataType: 'json',
                data: $('#formServer').serialize(),
                success: function (data) {
                    $('#id').val('');
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
                complete: function (data) {
                },
                error: function (data) {
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                url: "{{ route('servers.index') }}" + '/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
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
                complete: function (data) {
                },
                error: function (data) {
                    /** Criar as validações dos inputs para erros */
                }
            });
        });
    });
</script>
@stop