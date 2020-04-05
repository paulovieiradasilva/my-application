@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div id="buttons"></div>
                <div class="card-body">
                    <table id="employees_table" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Torre</th>
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

@include('admin.employees.form')

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#employees_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('employees_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'type' },
                { data: 'tower.name' },
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
                    $('#modalTitle').html('Novo funcionario');
                    $('#send').html('Cadastrar');
                    $('#send').removeClass('edit');
                    $('#send').addClass('save');
                    $('#formEmployee').trigger('reset');
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
        $('#formEmployee').trigger('reset');
        $('#name').removeClass('is-invalid');
        $('#type').removeClass('is-invalid');
        $('#send').removeClass('save');
        $('#send').removeClass('edit');
        $('#select-tower').removeClass('is-invalid');
        $('#select-tower').val(null).trigger('change');
    });

    /** LIST PERMISSIONS */
    $(document).ready(function () {
        $.ajax({
            url: "{{ url('towers') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, d) {
                    $('#select-tower').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            }
        })
    });

    /** CREATE  */
    $(document).on('click', '.save', function (event) {

        event.preventDefault();

        $.ajax({
            url: "{{ route('employees.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formEmployee').serialize(),
            success: function (data) {
                $('#id').val('');
                $('#formEmployee').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#employees_table').DataTable().ajax.reload(null, false);
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
            }
        });
    });

    /** EDIT  */
    $(document).on('click', '#edit-item', function (event) {

        event.preventDefault();

        let id = $(this).data('id');

        $('#send').removeClass('save');
        $('#send').addClass('edit');

        $.get("{{ route('employees.index') }}" + '/' + id + '/edit', function (data) {
            console.log(data);

            $('#modalTitle').html('Editar funcionario');
            $('#send').html('Atualizar');
            $('#modalFormCreate').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#type').val(data.type);
            $('#select-tower').val(data.tower_id).trigger('change');
            if (data.contacts != "") {
                $('#email').val(data.contacts[0].email);
                $('#phone').val(data.contacts[0].phone);
                $('#cellphone').val(data.contacts[0].cellphone);
            }
        });

        /** SEND FORM UPDATE */
        $('.edit').unbind().bind('click', function (event) {

            event.preventDefault();

            $.ajax({
                url: "{{ route('employees.index') }}" + '/' + id,
                type: 'PATCH',
                dataType: 'json',
                data: $('#formEmployee').serialize(),
                success: function (data) {
                    $('#id').val('');
                    $('#formEmployee').trigger('reset');
                    $('#modalFormCreate').modal('hide');
                    $('#employees_table').DataTable().ajax.reload(null, false);
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
                url: "{{ route('employees.index') }}" + '/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    $('#id').val('');
                    $('#employees_table').DataTable().ajax.reload(null, false);
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