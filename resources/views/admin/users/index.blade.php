@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="users_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
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

@include('admin.users.form')

@endsection

@section('scripts')
<script>
    /** LIST USERS */
    $(document).ready(function () {
        $('#users_table').DataTable({
            initComplete: function () {
                $('.card').show();
                $('#users_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('users_datatables') }}",
            pagingType: "simple_numbers",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
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
                },
                {
                    extend: 'excel',
                    className: 'btn btn-default'
                },
                {
                    text: 'Novo',
                    action: function () {
                        cleanFormDB('#formUser');
                        $('#modalTitle').html('Novo usuário');
                        /** */
                        removeSpinner("#created", 'Cadastrar');
                        $('.password').show(); // Mostrando o input PASSWORD
                        $('.password-confirm').show(); // Mostrando o input PASSWORD CONFIRM
                        $("#updated").hide();
                        $("#created").show();
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
    });

    /** LIST ALL */
    $(document).ready(function () {
        getSelectOptions("{{ url('roles') }}", "GET", "json", "#select-roles")
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        /** */
        addSpinner("#created", true);

        $.ajax({
            url: "{{ route('users.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formUser').serialize(),
            success: function (data) {
                cleanFormDB('#formUser');
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

                /** */
                removeSpinner("#created", 'Cadastrar');

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
                /** */
                removeSpinner("#updated", 'Atualizar');
                $('.password').hide(); // Ocultando o input PASSWORD
                $('.password-confirm').hide(); // Ocultando o input PASSWORD
                $('#modalFormCreate').modal('show');
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#select-roleS').val(itens).trigger('change');
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        /** */
        addSpinner("#updated", true);

        $.ajax({
            url: "{{ route('users.index') }}" + '/' + id,
            type: 'PUT',
            dataType: 'json',
            data: $('#formUser').serialize(),
            success: function (data) {
                cleanFormDB('#formUser');
                $('#id').val('');
                $('#modalFormCreate').modal('hide');
                $('#users_table').DataTable().ajax.reload(null, false);

                /** */
                removeSpinner("#updated", 'Atualizar');

                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) {},
            error: function (data) {

                /** */
                removeSpinner("#updated", 'Atualizar');
                
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
                $('#id').val('');
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
