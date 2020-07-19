@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <!-- <a style="float: left;" class="btn btn-default" href="{{ route('contacts.create') }}">Novo</a> -->
                    <table id="contacts_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Contato</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>E-mail</th>
                                <!-- <th>Site</th> -->
                                <th>Tipo</th>
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

@include('admin.contacts.form')

@endsection

@section('scripts')
<script>
    /** LIST CONTACTS */
    $(document).ready(function () {
        $("#contacts_table").DataTable({
            initComplete: function () {
                $(".card").show();
                $("#contacts_table").css("display", "inline-table").css("width", "inherit");
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('contacts_datatables') }}",
            columns: [
                { data: "id" },
                { data: "contactable.name" },
                { data: "phone" },
                { data: "cellphone" },
                { data: "email" },
                // { data: "site" },
                { data: "contactable_type" },
                { data: "created_at" },
                { data: "updated_at" },
                { data: "action" }
            ],
            order: [
                [0, "desc"]
            ],
            dom: "<'row'<'col-md-4'B><'col-md-5'l><'col-md-3'f>><'row'<'col-md-12'tr>><'row'<'col-md-3'i><'col-md-3'><'col-md-6'p>>",
            buttons: [{
                extend: "pdf",
                className: "btn btn-default"
            },
            {
                extend: "excel",
                className: "btn btn-default"
            },
            {
                text: "Novo",
                action: function () {
                    cleanFormDB('#formContact');
                    $('.type-employee-box').hide();
                    $('.type-provider-box').hide();
                    $("#modalTitle").html("Novo fornecedor");
                    $("#created").html("Cadastrar");
                    $("#updated").hide();
                    $("#created").show();
                    $("#modalFormCreate").modal("show");
                }
            }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });
    });

    /** RESET MODAL VALIDATIONS */
    $("#modalFormCreate").on("hide.bs.modal", function () {
    });

    /** GET LISTS */
    $(document).ready(function () {
        getSelectOptions("{{ url('providers-all') }}", "GET", "json", "#select-providers");
        getSelectOptions("{{ url('employees-all') }}", "GET", "json", "#select-users");
    });

    /** */
    $(document).ready(function() {
        $('input:radio[name="contactable_type"]').click(function() {
            let options = $('input[name="contactable_type"]:checked').val();

            if (options == "App\\Models\\Provider") {
                $('#select-users').val("").trigger('change');
                $('.type-provider-box').show();
                $('.type-employee-box').hide();
            }
            else {
                $('#select-providers').val("").trigger('change');
                $('.type-employee-box').show();
                $('.type-provider-box').hide();
            }
        })
    })

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE */
    function store() {

        $.ajax({
            url: "{{ route('contacts.store') }}",
            type: "POST",
            dataType: "json",
            data: $("#formContact").serialize(),
            success: function (data) {
                cleanFormDB('#formContact');
                $("#modalFormCreate").modal("hide");
                $("#contacts_table").DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) { },
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.contactable_type) {
                    $('#select-users').addClass('is-invalid');
                    $('#users-feedback').html(data.responseJSON.errors.contactable_type);

                    $('#select-providers').addClass('is-invalid');
                    $('#providers-feedback').html(data.responseJSON.errors.contactable_type);
                } else {
                    $('#select-users').removeClass('is-invalid');
                    $('#users-feedback').val('');

                    $('#select-providers').removeClass('is-invalid');
                    $('#providers-feedback').val('');
                }
                if (data.responseJSON.errors.email) {
                    $('#email').addClass('is-invalid');
                    $('#email-feedback').html(data.responseJSON.errors.email);
                } else {
                    $('#email').removeClass('is-invalid');
                    $('#email-feedback').val('');
                }
                if (data.responseJSON.errors.phone) {
                    $('#phone').addClass('is-invalid');
                    $('#phone-feedback').html(data.responseJSON.errors.phone);
                } else {
                    $('#phone').removeClass('is-invalid');
                    $('#phone-feedback').val('');
                }
                if (data.responseJSON.errors.cellphone) {
                    $('#cellphone').addClass('is-invalid');
                    $('#cellphone-feedback').html(data.responseJSON.errors.cellphone);
                } else {
                    $('#cellphone').removeClass('is-invalid');
                    $('#cellphone-feedback').val('');
                }
            }
        });
    }

    /** EDIT */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('contacts.index') }}" + "/" + id + "/edit",
            function (data) {

                console.log(data);

                $("#modalTitle").html("Editar contato");
                $("#updated").html("Atualizar");
                $("#modalFormCreate").modal("show");

                if (data.contactable_type == "App\\Models\\Employee") {
                    $('#1').prop('checked', true);
                    $('.type-employee-box').show();
                    $('.type-provider-box').hide();
                }
                if (data.contactable_type == "App\\Models\\Provider") {
                    $('#2').prop('checked', true);
                    $('.type-provider-box').show();
                    $('.type-employee-box').hide();
                    $("#site").val(data.site);
                }
                $("#email").val(data.email);
                $("#phone").val(data.phone);
                $("#cellphone").val(data.cellphone);
                $('#id').val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('contacts.index') }}" + "/" + id,
            type: "PATCH",
            dataType: "json",
            data: $("#formContact").serialize(),
            success: function (data) {
                cleanFormDB('#formContact');
                $('#id').val('');
                $("#modalFormCreate").modal("hide");
                $("#contacts_table").DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) { },
            error: function (data) {
                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $("#name").addClass("is-invalid");
                    $("#name-feedback").html(data.responseJSON.errors.name);
                }
            }
        });
    }

    /** DELETE */
    function destroy(id) {

        var id = $('#id').val();

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            url: "{{ route('contacts.index') }}" + "/" + id,
            type: "DELETE",
            dataType: "json",
            success: function (data) {
                $('#id').val('');
                $("#contacts_table").DataTable().ajax.reload(null, false);
                $("#deleteModalCenter").modal("hide");
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) { },
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