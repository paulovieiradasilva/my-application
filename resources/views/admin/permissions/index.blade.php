@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <table id="permissions_table" class="table table-hover table-sm">
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

@include('admin.permissions.form')

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#permissions_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('permissions_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'slug' },
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
                action: function () {
                    $('#modalTitle').html('Nova permissão');
                    $('#send').html('Cadastrar');
                    $('#id').val('');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formPermission').trigger('reset');
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
            $('#name').removeClass('is-invalid');
            $('#slug').removeClass('is-invalid');
            $('#send').removeClass('save');
            $('#send').removeClass('edit');
            $('#formPermission').trigger('reset');
        });

        /** SUBMIT FORM */
        $('#formPermission').on('submit', function (event) {
            event.preventDefault();
        });

        /** CREATE  */
        $(document).on('click', '.save', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('permissions.store') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#formPermission').serialize(),
                success: function (data) {
                    $('#formPermission').trigger('reset');
                    $('#modalFormCreate').modal('hide');
                    $('#permissions_table').DataTable().ajax.reload();
                },
                error: function (data) {
                    /** Criar as validações dos inputs para erros */
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                    $('#slug').addClass('is-invalid');
                    $('#slug-feedback').html(data.responseJSON.errors.slug);
                }
            });
        });

        /** EDIT  */
        $(document).on('click', '#edit-item', function (event) {

            event.preventDefault();

            let id = $(this).data('id');

            $('#send').removeClass('save');
            $('#send').addClass('edit');

            $.get("{{ route('permissions.index') }}" + '/' + id + '/edit', function (data) {
                $('#modalTitle').html('Editar permissão');
                $('#send').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#slug').val(data.slug);
                $('#description').val(data.description);
            });

            /** SEND FORM UPDATE */
            $('.edit').click(function (event) {

                event.preventDefault();

                $.ajax({
                    url: "permissoes/" + id,
                    type: 'PUT',
                    dataType: 'json',
                    data: $('#formPermission').serialize(),
                    success: function (data) {
                        $('#formPermission').trigger('reset');
                        $('#modalFormCreate').modal('hide');
                        $('#permissions_table').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        /** Criar as validações dos inputs para erros */
                        if ($('#name').val() == "") {
                            $('#name').addClass('is-invalid');
                            $('#name-feedback').html(data.responseJSON.errors.name);
                        }
                        if ($('#slug').val() == "") {
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
            $('#send-delete').click(function (event) {

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
                    url: "permissoes/" + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        $('#permissions_table').DataTable().ajax.reload();
                        $('#deleteModalCenter').modal('hide');
                    },
                    error: function (data) {
                        /** Criar as validações dos inputs para erros */
                    }
                });
            });

        });
    });
</script>
@stop