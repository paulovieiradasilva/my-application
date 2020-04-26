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
                    <table id="providers_table" class="table table-hover table-sm" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Atendimento</th>
                                <th>Plantão</th>
                                <th>Criado</th>
                                <th>Atualizado</th>
                                <th style="width: 35px;"></th>
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
                $("#loader").hide();
                $("#providers_table").css("display", "inline-table").css("width", "inherit");
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ url('providers_datatables') }}",
            columns: [
                {data: "id"},
                {data: "name"},
                {data: "opening_hours"},
                {data: "on_duty"},
                {data: "created_at"},
                {data: "updated_at"},
                {data: "action"}
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
                        $("#modalTitle").html("Novo fornecedor");
                        $("#created").html("Cadastrar");
                        $("#updated").hide();
                        $("#created").show();
                        $("#formProvider").trigger("reset");
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
        cleanFormValidation();
        $("#formProvider").trigger("reset");
        $('#on_duty').val(null).trigger('change');
    });

    /** ::::::::::::::::::::::::: FUNCTIONS ::::::::::::::::::::::::: */

    /** CREATE  */
    function store() {

        $.ajax({
            url: "{{ route('providers.store') }}",
            type: "POST",
            dataType: "json",
            data: $("#formProvider").serialize(),
            success: function (data) {
                $("#formProvider").trigger("reset");
                $("#modalFormCreate").modal("hide");
                $("#providers_table").DataTable().ajax.reload(null, false);
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
            }
        });
    }

    /** EDIT */
    function edit(id) {

        $("#updated").show();
        $("#created").hide();

        $.get(
            "{{ route('providers.index') }}" + "/" + id + "/edit",
            function (data) {
                $("#modalTitle").html("Editar forncedor");
                $("#updated").html("Atualizar");
                $("#modalFormCreate").modal("show");
                $("#name").val(data.name);
                $("#opening_hours").val(data.opening_hours);
                $("#on_duty").val(data.on_duty);
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

        $.ajax({
            url: "{{ route('providers.index') }}" + "/" + id,
            type: "PATCH",
            dataType: "json",
            data: $("#formProvider").serialize(),
            success: function (data) {
                $("#formProvider").trigger("reset");
                $("#modalFormCreate").modal("hide");
                $("#providers_table").DataTable().ajax.reload(null, false);
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
            }
        });

        $('#id').val('');
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
                $("#providers_table").DataTable().ajax.reload(null, false);
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

    /** CLEAN FORM VALIDATION */
    function cleanFormValidation(selector, cls) {

        $('input[name='+selector+']').each(function(){
            $('input[name='+selector+']').removeClass(cls);
        });

    }

</script>
@stop
