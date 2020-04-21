@extends('layouts.app') @section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div style="display: none;" id="buttons"></div>
                <div class="card-body">
                    <div id="loader">Carregando... <img src="{{ asset('img/loaders/loader-grey.gif') }}"></div>
                    <table id="permissions_table" class="table table-hover table-sm" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Slug</th>
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

@include('admin.permissions.form') @endsection @section('scripts')
<script>
    /** LIST PERMISSIONS */
    $(document).ready(function () {
        $("#permissions_table").DataTable({
            initComplete: function () {
                $("#loader").hide();
                $("#permissions_table").css("display", "inline-table").css("width", "inherit");
            },
            processing: true,
            serverSide: true,
            ajax: "{{ url('permissions_datatables') }}",
            columns: [{
                    data: "id"
                },
                {
                    data: "name"
                },
                {
                    data: "slug"
                },
                {
                    data: "description"
                },
                {
                    data: "created_at"
                },
                {
                    data: "updated_at"
                },
                {
                    data: "action"
                }
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
        $("#id").val("");
        $("#formPermission").trigger("reset");
        $("#name").removeClass("is-invalid");
        $("#slug").removeClass("is-invalid");
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
            complete: function (data) {},
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
            complete: function (data) {},
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

        $("#id").val('');
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
                $("#permissions_table").DataTable().ajax.reload(null, false);
                $("#deleteModalCenter").modal("hide");
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
