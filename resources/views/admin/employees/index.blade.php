@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <table id="employees_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Torre</th>
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

@include('admin.employees.form')

@endsection

@section('scripts')
<script>
    /** LIST EMPLOYEES */
    $(document).ready(function () {
        $('#employees_table').DataTable({
            initComplete: function () {
                $('.card').show();
                $('#employees_table').css('display', 'inline-table').css('width', 'inherit');
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
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
                action: function (e, dt, node, config) {
                    $('#modalTitle').html('Novo funcionario');
                    $("#created").html("Cadastrar");
                    $("#updated").hide();
                    $("#created").show();
                    $('#formEmployee').trigger('reset');
                    $('#modalFormCreate').modal('show');
                }
            }],
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
        getSelectOptions("{{ url('towers')}}", "GET", "json", "#select-towers");
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('employees.store') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#formEmployee').serialize(),
            success: function (data) {
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
            complete: function (data) {},
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('employees.index') }}" + '/' + id + '/edit',
            function (data) {
                $('#modalTitle').html('Editar funcionario');
                $('#updated').html('Atualizar');
                $('#modalFormCreate').modal('show');
                $('#name').val(data.name);
                if (data.contacts != null) {
                    $('#email').val(data.contacts.email);
                    $('#phone').val(data.contacts.phone);
                    $('#cellphone').val(data.contacts.cellphone);
                }
                $('#type').val(data.type).trigger('change');
                $('#select-towers').val(data.tower_id).trigger('change');
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

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
            complete: function (data) {},
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $('#name').addClass('is-invalid');
                    $('#name-feedback').html(data.responseJSON.errors.name);
                }
            }
        });
    }

    /** DELETE  */
    function destroy() {

        var id = $('#id').val();

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

    /** CLEAN FORM VALIDATION */
    function cleanFormValidation(selector, cls) {

        $('input[name='+selector+']').each(function(){
            $('input[name='+selector+']').removeClass(cls);
        });

    }

</script>
@stop
