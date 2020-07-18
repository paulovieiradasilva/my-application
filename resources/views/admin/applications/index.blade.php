@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="applications_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Start</th>
                                <th>Plataforma</th>
                                <th>Tipo</th>
                                <th>Fornecedor</th>
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

@include('admin.applications.form')

@endsection

@section('scripts')
<script>
    /** LIST SERVERS */
    $(document).ready(function() {
        $('#applications_table').DataTable({
            initComplete: function() {
                $('.card').show();
                $('#applications_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('applications_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'start' },
                { data: 'platform' },
                { data: 'type' },
                { data: 'provider.name' },
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
                    cleanFormDB('#formApplication');
                    $('#modalTitle').html('Nova aplicação');
                    $("#created").html("Cadastrar");
                    $("#updated").hide();
                    $("#created").show();
                    $('#formApplication').trigger('reset');
                    $('#modalFormCreate').modal('show');
                }
            }],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });
    });

    /** RESET MODAL VALIDATIONS */
    $("#modalFormCreate").on("hide.bs.modal", function() {});

    /** GET LISTS */
    $(document).ready(function() {
        getSelectOptions("{{ url('providers-all') }}", "GET", "json", "#select-providers");
        getSelectOptions("{{ url('servers-all') }}", "GET", "json", "#select-servers");
        getSelectOptions("{{ url('employees-all') }}", "GET", "json", "#select-users");
        getSelectOptions("{{ url('towers-all') }}", "GET", "json", "#select-towers");
        getSelectOptions("{{ url('environments-all') }}", "GET", "json", "#select-environments");
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('applications.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formApplication').serialize(),
            success: function(data) {
                cleanFormDB('#formApplication');
                $('#modalFormCreate').modal('hide');
                $('#applications_table').DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.platform) {
                    $('#platform').addClass('is-invalid');
                    $('#platform-feedback').html(data.responseJSON.errors.platform);
                } else {
                    $('#platform').removeClass('is-invalid');
                    $('#platform-feedback').val('');
                }
                if (data.responseJSON.errors.start) {
                    $('#start').addClass('is-invalid');
                    $('#start-feedback').html(data.responseJSON.errors.start);
                } else {
                    $('#start').removeClass('is-invalid');
                    $('#start-feedback').val('');
                }
                if (data.responseJSON.errors.type) {
                    $('#type').addClass('is-invalid');
                    $('#type-feedback').html(data.responseJSON.errors.type);
                } else {
                    $('#type').removeClass('is-invalid');
                    $('#type-feedback').val('');
                }
                if (data.responseJSON.errors.provider_id) {
                    $('#select-providers').addClass('is-invalid');
                    $('#provider-feedback').html(data.responseJSON.errors.provider_id);
                } else {
                    $('#select-provider').removeClass('is-invalid');
                    $('#provider-feedback').val('');
                }
                if (data.responseJSON.errors.tower_id) {
                    $('#select-towers').addClass('is-invalid');
                    $('#tower-feedback').html(data.responseJSON.errors.tower_id);
                } else {
                    $('#select-towers').removeClass('is-invalid');
                    $('#tower-feedback').val('');
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('applications.index') }}" + '/' + id + '/edit',
            function(data) {

                /** */
                let servers = [];
                data.data.application.servers.forEach(element => servers.push(element.id));

                /** */
                let employees = [];
                data.data.application.employees.forEach(element => employees.push(element.id));

                $('#modalTitle').html('Editar aplicação');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#name').val(data.data.application.name);
                $('#platform').val(data.data.application.platform);
                $('#select-providers').val(data.data.application.provider.id).trigger('change');
                $('#select-servers').val(servers).trigger('change');
                $('#select-users').val(employees).trigger('change');
                $('#type').val(data.data.application.type).trigger('change');
                $('#start').val(data.data.application.start).trigger('change');
                $('#select-towers').val(data.data.application.tower_id).trigger('change');

                /** */
                if (data.data.application.credential != null) {
                    $('#username').val(data.data.application.credential.username);
                    $('#password').val(data.data.application.credential.password);
                }

                $('#description').val(data.data.application.description);
                $('#id').val(data.data.application.id);
            });
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('applications.index') }}" + '/' + id,
            type: 'PATCH',
            dataType: 'json',
            data: $('#formApplication').serialize(),
            success: function(data) {
                cleanFormDB('#formApplication');
                $('#id').val('');
                $('#modalFormCreate').modal('hide');
                $('#applications_table').DataTable().ajax.reload(null, false);
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

    }

    /** DELETE  */
    function destroy(id) {

        var id = $('#id').val();

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            url: "{{ route('applications.index') }}" + '/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(data) {
                $('#applications_table').DataTable().ajax.reload(null, false);
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

</script>
@stop