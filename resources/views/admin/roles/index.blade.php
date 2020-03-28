@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <table id="roles_table" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Slug</th>
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

@include('admin.roles.form')

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#roles_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('roles_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'slug' },
                { data: 'description' },
                { data: 'created_at' },
                { data: 'updated_at' },
                { data: 'action' }
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
                action: function (e, dt, node, config) {
                    $('#id').val('');
                    $('#modalTitle').html('Novo papél');
                    $('#send').html('Cadastrar');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formRole').trigger('reset');
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
        $('#formRole').trigger('reset');
        $('#name').removeClass('is-invalid');
        $('#slug').removeClass('is-invalid');
        $('#send').removeClass('save');
        $('#send').removeClass('edit');
        $('#select-permission').val(null).trigger('change');
    });

    /** LIST PERMISSIONS */
    $(document).ready(function () {
        $.ajax({
            url: "{{ url('permissions') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, d) {
                    $('#select-permission').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            }
        })
    });

    /** CREATE  */
    $(document).on('click', '.save', function (event) {

        event.preventDefault();

        $.ajax({
            url: "{{ route('roles.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formRole').serialize(),
            success: function (data) {
                $('#id').val('');
                $('#formRole').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#roles_table').DataTable().ajax.reload(null, false);
                toastr.success(data.msg);
            },
            complete: function (data) {
            },
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.slug) {
                    $('#slug').addClass('is-invalid');
                    $('#slug-feedback').html(data.responseJSON.errors.slug);
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

        $.get("{{ route('roles.index') }}" + '/' + id + '/edit', function (data) {

            let itens = [];
            data.permissions.forEach(element => {
                itens.push(element.id);
            });

            $('#modalTitle').html('Editar papél');
            $('#send').html('Atualizar');
            $('#modalFormCreate').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#slug').val(data.slug);
            $('#description').val(data.description);
            $('#select-permission').val(itens).trigger('change');
        });

        /** SEND FORM UPDATE */
        $('.edit').unbind().bind('click', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('roles.index') }}" + '/' + id,
                type: 'PUT',
                dataType: 'json',
                data: $('#formRole').serialize(),
                success: function (data) {
                    $('#id').val('');
                    $('#formRole').trigger('reset');
                    $('#modalFormCreate').modal('hide');
                    $('#roles_table').DataTable().ajax.reload(null, false);
                    toastr.success(data.msg);
                },
                complete: function (data) {
                },
                error: function (data) {
                    /** Criar as validações dos inputs para erros */
                    if (data.responseJSON.errors.name) {
                        $('#name').addClass('is-invalid');
                        $('#name-feedback').html(data.responseJSON.errors.name);
                    }
                    if (data.responseJSON.errors.slug) {
                        $('#slug').addClass('is-invalid');
                        $('#slug-feedback').html(data.responseJSON.errors.slug);
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
                url: "{{ route('roles.index') }}" + '/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    $('#id').val('');
                    $('#roles_table').DataTable().ajax.reload(null, false);
                    $('#deleteModalCenter').modal('hide');
                    toastr.success(data.msg);
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