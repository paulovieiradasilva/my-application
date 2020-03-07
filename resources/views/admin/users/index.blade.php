@extends('layouts.app')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header"></div> -->
                <div class="card-body">
                    <table id="users" class="table table-bordered table-hover table-sm">
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('users_datatables') }}",
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'created_at' },
                { data: 'updated_at' },
                { data: 'action' }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });
    });
</script>
@stop