@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <table id="environments_table" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
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

@include('admin.environments.form')

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#environments_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('environments_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
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
                    $('#id').val('');
                    $('#modalTitle').html('Novo ambiente');
                    $('#send').html('Cadastrar');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formEnvironment').trigger('reset');
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
            $('#id').val('');
            $('#formEnvironment').trigger('reset');
            $('#name').removeClass('is-invalid');
            $('#description').removeClass('is-invalid');
            $('#send').removeClass('save');
            $('#send').removeClass('edit');
        });

        /** CREATE  */
        $(document).on('click', '.save', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('environments.store') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#formEnvironment').serialize(),
                success: function (data) {
                    $('#id').val('');
                    $('#formEnvironment').trigger('reset');
                    $('#modalFormCreate').modal('hide');
                    $('#environments_table').DataTable().ajax.reload(null, false);
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
                    if (data.responseJSON.errors.description) {
                        $('#description').addClass('is-invalid');
                        $('#description-feedback').html(data.responseJSON.errors.description);
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

            $.get("{{ route('environments.index') }}" + '/' + id + '/edit', function (data) {
                $('#modalTitle').html('Editar ambinente');
                $('#send').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
            });

            /** SEND FORM UPDATE */
            $('.edit').unbind().bind('click', function (event) {

                event.preventDefault();

                $.ajax({
                    url: "{{ route('environments.index') }}" + '/' + id,
                    type: 'PATCH',
                    dataType: 'json',
                    data: $('#formEnvironment').serialize(),
                    success: function (data) {
                        $('#id').val('');
                        $('#formEnvironment').trigger('reset');
                        $('#modalFormCreate').modal('hide');
                        $('#environments_table').DataTable().ajax.reload(null, false);
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
                        if (data.responseJSON.errors.description) {
                            $('#description').addClass('is-invalid');
                            $('#description-feedback').html(data.responseJSON.errors.description);
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
                    url: "{{ route('environments.index') }}" + '/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        $('#id').val('');
                        $('#environments_table').DataTable().ajax.reload(null, false);
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
    });
</script>
@stop