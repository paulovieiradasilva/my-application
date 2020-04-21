@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div style="display: none;" id="buttons"></div>
                <div class="card-body">
                    <div id="loader">Carregando... <img src="{{ asset('img/loaders/loader-grey.gif') }}"></div>
                    <table id="users_table" class="table table-hover table-sm" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
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

@include('admin.users.form')

@endsection

@section('scripts')
<script>
    /** LIST USERS */
    $(document).ready(function () {
        $('#users_table').DataTable({
            initComplete: function () {
                $('#loader').hide();
                $('#users_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            ajax: "{{ url('users_datatables') }}",
            pagingType: "simple_numbers",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'action'
                }
            ],
            order: [
                [0, 'desc']
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
                    action: function () {
                        $('.password').show(); // Mostrando o input PASSWORD
                        $('.password-confirm').show(); // Mostrando o input PASSWORD CONFIRM
                        $('#modalTitle').html('Novo usuário');
                        $("#created").html("Cadastrar");
                        $("#updated").hide();
                        $("#created").show();
                        $('#formUser').trigger('reset');
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
        $('#formUser').trigger('reset');
        $('#name').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
        $('#password-confirm').removeClass('is-invalid');
        $('#send').removeClass('save');
        $('#send').removeClass('edit');
        $('#select-role').val(null).trigger('change');
    });

    /** LIST ROLES */
    $(document).ready(function () {
        $.ajax({
            url: "{{ url('roles') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, d) {
                    $('#select-role').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
            }
        })
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('users.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formUser').serialize(),
            success: function (data) {
                $('#formUser').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#users_table').DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {

                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.email) {
                    $('#email').addClass('is-invalid');
                    $('#email-feedback').html(data.responseJSON.errors.email);
                }
                if (data.responseJSON.errors.password) {
                    $('#password').addClass('is-invalid');
                    $('#password-feedback').html(data.responseJSON.errors.password);
                }
                if (data.responseJSON.errors.password) {
                    $('#password-confirm').addClass('is-invalid');
                    $('#password-confirm-feedback').html(data.responseJSON.errors.password);
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('users.index') }}" + '/' + id + '/edit',
            function (data) {

                let itens = [];
                data.roles.forEach(element => {
                    itens.push(element.id);
                });

                $('#modalTitle').html('Editar usuário');
                $('#updated').html('Atualizar');
                $('.password').hide(); // Ocultando o input PASSWORD
                $('.password-confirm').hide(); // Ocultando o input PASSWORD
                $('#modalFormCreate').modal('show');
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#select-role').val(itens).trigger('change');
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('users.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formUser').serialize(),
            success: function (data) {
                $('#formUser').trigger('reset');
                $('#modalFormCreate').modal('hide');
                $('#users_table').DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.email) {
                    $('#email').addClass('is-invalid');
                    $('#email-feedback').html(data.responseJSON.errors.email);
                }
                if (data.responseJSON.errors.password) {
                    $('#password').addClass('is-invalid');
                    $('#password-feedback').html(data.responseJSON.errors.password);
                }
                if (data.responseJSON.errors.password) {
                    $('#password-confirm').addClass('is-invalid');
                    $('#password-confirm-feedback').html(data.responseJSON.errors.password);
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
            url: "{{ route('users.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                $('#users_table').DataTable().ajax.reload(null, false);
                $('#deleteModalCenter').modal('hide');
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {
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

</script>
@stop
