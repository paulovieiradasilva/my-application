<input type="hidden" name="id" id="id">

<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" placeholder="Nome">
        <div id="name-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="ip" class="col-sm-2 col-form-label">IP</label>
    <div class="col-sm-10">
        <input type="text" id="ip" name="ip" class="form-control" placeholder="IP">
        <div id="ip-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="os" class="col-sm-2 col-form-label">S.O</label>
    <div class="col-sm-10">
        <input type="text" id="os" name="os" class="form-control" placeholder="Sistema Operacional">
        <div id="os-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label">Usuário</label>
    <div class="col-sm-10">
        <input type="text" id="username" name="username" class="form-control" placeholder="Usuário">
        <div id="username-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Senha</label>
    <div class="col-sm-10">
        <input type="text" id="password" name="password" class="form-control" placeholder="Senha">
        <div id="password-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="type" id="type" class="form-control" placeholder="Tipo">
            <option disabled="disabled" selected="selected">Selecione um item</option>
            <option value="application">Aplicação</option>
            <option value="database">Banco de Dados</option>
        </select>
        <div id="type-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div id="table" style="display: none;" class="form-group row">
    <label for="type" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
        <h6 class="m-0 mb-2">Informe abaixo o(s) banco(s) deste servidor</h6>
        <small id="error-msg" style="display: none;" class="text-danger mb-1">Campos de preenchimento obrigatorio</small>
        <div class="content">
            <table id="server-table" class="table table-hover table-bordered table-sm">
                <thead>
                    <th><input class="form-control form-control-sm" type="text" id="dbn" placeholder="Nome"></th>
                    <th><input class="form-control form-control-sm" type="text" id="sgdb" placeholder="SGDB"></th>
                    <th><input class="form-control form-control-sm" type="text" id="port" placeholder="Porta"></th>
                    <th><input class="form-control form-control-sm" type="text" id="usr" placeholder="Usuário"></th>
                    <th><input class="form-control form-control-sm" type="text" id="pwd" placeholder="Senha"></th>
                    <th>
                        <a href="#" style="display: none;" id="add-item-table" class="btn btn-xs btn-primary my-1 p-1"> Adicionar</a>
                        <a href="#" style="display: none;" onclick="addItem()" id="edit-item-table" class="btn btn-xs btn-success my-1 p-1"> Adicionar</a>
                    </th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="environment_id" class="col-sm-2 col-form-label">Ambientes</label>
    <div class="col-sm-10">
        <select name="environment_id" id="select-environment" class="form-control" data-placeholder="Ambientes">
            <option disabled="disabled" selected="selected">Selecione um item</option>
        </select>
        <div id="environment-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Descrição"></textarea>
    </div>
</div>
