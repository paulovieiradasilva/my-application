@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <table id="providers_table" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Atendimento</th>
                                <th>Plantão</th>
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

@include('admin.providers.form')

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#providers_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('providers_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'opening_hours' },
                { data: 'on_duty' },
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
                    $('#modalTitle').html('Novo fornecedor');
                    $('#send').html('Cadastrar');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formProvider').trigger('reset');
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
            $('#formProvider').trigger('reset');
            $('#name').removeClass('is-invalid');
            $('#opening_hours').removeClass('is-invalid');
            $('#on_duty').removeClass('is-invalid');
            $('#send').removeClass('save');
            $('#send').removeClass('edit');
        });

        /** CREATE  */
        $(document).on('click', '.save', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('providers.store') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#formProvider').serialize(),
                success: function (data) {
                    $('#id').val('');
                    $('#formProvider').trigger('reset');
                    $('#modalFormCreate').modal('hide');
                    $('#providers_table').DataTable().ajax.reload(null, false);
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
                }
            });
        });

        /** EDIT  */
        $(document).on('click', '#edit-item', function (event) {

            event.preventDefault();

            let id = $(this).data('id');

            $('#send').removeClass('save');
            $('#send').addClass('edit');

            $.get("{{ route('providers.index') }}" + '/' + id + '/edit', function (data) {
                console.log(data);

                $('#modalTitle').html('Editar permissão');
                $('#send').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#opening_hours').val(data.opening_hours);
                $('#on_duty').val(data.on_duty);
                $('#description').val(data.description);
            });

            /** SEND FORM UPDATE */
            $('.edit').unbind().bind('click', function (event) {

                event.preventDefault();

                $.ajax({
                    url: "{{ route('providers.index') }}" + '/' + id,
                    type: 'PATCH',
                    dataType: 'json',
                    data: $('#formProvider').serialize(),
                    success: function (data) {
                        $('#id').val('');
                        $('#formProvider').trigger('reset');
                        $('#modalFormCreate').modal('hide');
                        $('#providers_table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    },
                    complete: function (data) {
                    },
                    error: function (data) {
                        /** Criar as validações dos inputs para erros */
                        if ($('#name').val() == "") {
                            $('#name').addClass('is-invalid');
                            $('#name-feedback').html(data.responseJSON.errors.name);
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
                    url: "{{ route('providers.index') }}" + '/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                        $('#id').val('');
                        $('#providers_table').DataTable().ajax.reload(null, false);
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