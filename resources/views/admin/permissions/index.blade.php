@extends('layouts.app') @section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="display: none;">
                <!-- <div class="card-header"></div> -->
                <div style="display: none;" id="buttons"></div>
                <div class="card-body">
                    <table id="permissions_table" class="table table-hover table-sm animated fadeIn" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Slug</th>
                                <th>Descição</th>
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

@include('admin.permissions.form') @endsection @section('scripts')
<script>
    /** LIST PERMISSIONS */
    $(document).ready(function () {
        $("#permissions_table").DataTable({
            initComplete: function () {
                $(".card").show();
                $("#permissions_table").css("display", "inline-table").css("width", "inherit");
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('permissions_datatables') }}",
            columns: [
                { data: "id" },
                { data: "name" },
                { data: "slug" },
                { data: "description" },
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
                    $("#modalTitle").html("Nova permissão");
                    $("#created").html("Cadastrar");
                    $("#updated").hide();
                    $("#created").show();
                    $("#formPermission").trigger("reset");
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

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('permissions.store') }}",
            type: "POST",
            dataType: "json",
            data: $("#formPermission").serialize(),
            success: function (data) {
                $("#formPermission").trigger("reset");
                $("#modalFormCreate").modal("hide");
                $("#permissions_table").DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.slug) {
                    $("#slug").addClass("is-invalid");
                    $("#slug-feedback").html(data.responseJSON.errors.slug);
                }
            }
        });
    }

    /** EDIT  */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('permissions.index') }}" + "/" + id + "/edit",
            function (data) {
                $("#modalTitle").html("Editar permissão");
                $("#updated").html("Atualizar");
                $("#modalFormCreate").modal("show");
                $("#name").val(data.name);
                $("#slug").val(data.slug);
                $("#description").val(data.description);
                $("#id").val(data.id);
            }
        );
    }

    /** UPDATE */
    function update() {

        var id = $('#id').val();

        $.ajax({
            url: "{{ route('permissions.index') }}" + "/" + id,
            type: "PUT",
            dataType: "json",
            data: $("#formPermission").serialize(),
            success: function (data) {
                $('#id').val('');
                $("#formPermission").trigger("reset");
                $("#modalFormCreate").modal("hide");
                $("#permissions_table").DataTable().ajax.reload(null, false);
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
                if (data.responseJSON.errors.slug) {
                    $("#slug").addClass("is-invalid");
                    $("#slug-feedback").html(data.responseJSON.errors.slug);
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
            url: "{{ route('permissions.index') }}" + "/" + id,
            type: "DELETE",
            dataType: "json",
            success: function (data) {
                $('#id').val('');
                $("#permissions_table").DataTable().ajax.reload(null, false);
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