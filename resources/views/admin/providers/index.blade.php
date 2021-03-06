@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <div class="card-body">
                    <!-- <a style="float: left;" class="btn btn-default" href="{{ route('providers.create') }}">Novo</a> -->
                    <table id="providers_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Atendimento</th>
                                <th>Plantão</th>
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

@include('admin.providers.form')

@endsection

@section('scripts')
<script>
    /** LIST PROVIDERS */
    $(document).ready(function () {
        $("#providers_table").DataTable({
            initComplete: function () {
                $(".card").show();
                $("#providers_table").css("display", "inline-table").css("width", "inherit");
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('providers_datatables') }}",
            columns: [
                { data: "id" },
                { data: "name" },
                { data: "opening_hours" },
                { data: "on_duty" },
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
                    cleanFormDB('#formProvider');
                    $("#modalTitle").html("Novo fornecedor");
                    /** */
                    removeSpinner("#created", 'Cadastrar');
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

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE */
    function store() {

        /** */
        addSpinner("#created", true);

        $.ajax({
            url: "{{ route('providers.store') }}",
            type: "POST",
            dataType: "json",
            data: $("#formProvider").serialize(),
            success: function (data) {
                cleanFormDB('#formProvider');
                $("#modalFormCreate").modal("hide");
                $("#providers_table").DataTable().ajax.reload(null, false);
                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) { },
            error: function (data) {

                /** */
                removeSpinner("#created", 'Cadastrar');

                /** Criar as validações dos inputs para erros */
                if (data.responseJSON.errors.name) {
                    $("#name").addClass("is-invalid");
                    $("#name-feedback").html(data.responseJSON.errors.name);
                }
            }
        });
    }

    /** EDIT */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        cleanFormDB('#formProvider');

        $.get(
            "{{ route('providers.index') }}" + "/" + id + "/edit",
            function (data) {
                $("#modalTitle").html("Editar forncedor");
                /** */
                removeSpinner("#updated", 'Atualizar');
                $("#modalFormCreate").modal("show");
                $("#name").val(data.name);
                $("#opening_hours").val(data.opening_hours);
                $("#on_duty").val(data.on_duty).trigger("change");
                $("#description").val(data.description);
                if (data.contacts != null) {
                    $("#email").val(data.contacts.email);
                    $("#site").val(data.contacts.site);
                    $("#phone").val(data.contacts.phone);
                    $("#cellphone").val(data.contacts.cellphone);
                }
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
            url: "{{ route('providers.index') }}" + "/" + id,
            type: "PATCH",
            dataType: "json",
            data: $("#formProvider").serialize(),
            success: function (data) {

                cleanFormDB('#formProvider');
                $('#id').val('');
                $("#modalFormCreate").modal("hide");
                $("#providers_table").DataTable().ajax.reload(null, false);

                /** */
                removeSpinner("#updated", 'Atualizar');

                if (data.success) {
                    toastr.success(data.success);
                }
                if (data.error) {
                    toastr.error(data.error);
                }
            },
            complete: function (data) { },
            error: function (data) {

                /** */
                removeSpinner("#updated", 'Atualizar');

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
            url: "{{ route('providers.index') }}" + "/" + id,
            type: "DELETE",
            dataType: "json",
            success: function (data) {
                $('#id').val('');
                $("#providers_table").DataTable().ajax.reload(null, false);
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

    /** CLEAN FORM VALIDATION */
    function cleanFormValidation(selector, cls) {

        $('input[name=' + selector + ']').each(function () {
            $('input[name=' + selector + ']').removeClass(cls);
        });

    }

</script>
@stop