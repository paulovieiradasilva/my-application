<div id="table" style="display: none;" class="form-group row">
    <label for="type" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
        <h6 class="m-0 mb-2">Informe abaixo o(s) banco(s) para este servidor</h6>
        <small id="error-msg" style="display: none;" class="text-danger">
            <i class="fas fa-exclamation-circle"></i>
            <b>NOME</b>, <b>SGDB</b>, <b>PORTA</b>, <b>USUÁRIO</b> e <b>SENHA</b> são de preenchimento obrigatorio.
        </small>
        <div class="content">
            <table id="server-table" class="table table-hover table-bordered table-sm">
                <thead>
                    <th><input class="form-control form-control-sm" name="is-empty" type="text" id="dbn" placeholder="Nome"></th>
                    <th><input class="form-control form-control-sm" name="is-empty" type="text" id="sgdb" placeholder="SGDB"></th>
                    <th><input class="form-control form-control-sm" name="is-empty" type="text" id="port" placeholder="Porta"></th>
                    <th><input class="form-control form-control-sm" name="is-empty" type="text" id="usr" placeholder="Usuário"></th>
                    <th><input class="form-control form-control-sm" name="is-empty" type="text" id="pwd" placeholder="Senha"></th>
                    <th>
                        <a href="#" style="display: none;" onclick="addItemToTable()" id="add-item-table" class="btn btn-xs btn-primary my-1 p-1">
                            Adicionar
                        </a>
                        <a href="#" style="display: none;" onclick="addItem()" id="edit-item-table" class="btn btn-xs btn-success my-1 p-1">
                            Adicionar
                        </a>
                    </th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>