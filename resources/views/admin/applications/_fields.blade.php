<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" placeholder="Aplicação">
        <div id="name-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="platform" class="col-sm-2 col-form-label">Plataforma</label>
    <div class="col-sm-10">
        <input type="text" id="platform" name="platform" class="form-control" placeholder="Plataforma">
        <div id="platform-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="provider_id" class="col-sm-2 col-form-label">Fornecedor</label>
    <div class="col-sm-10">
        <select name="provider_id" id="select-providers" class="form-control select2" data-placeholder="Fornecedores">
            <option disabled selected></option>
        </select>
        <div id="provider-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="type" id="type" class="form-control select2" data-placeholder="Tipo">
            <option disabled selected></option>
            <option value="Web">Web</option>
            <option value="Executável">Executável</option>
        </select>
        <div id="type-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="start" class="col-sm-2 col-form-label">Start</label>
    <div class="col-sm-10">
        <select name="start" id="start" class="form-control select2" data-placeholder="Start">
            <option disabled selected></option>
            <option value="Automático">Automático</option>
            <option value="Manual">Manual</option>
        </select>
        <div id="start-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="tower_id" class="col-sm-2 col-form-label">Torres</label>
    <div class="col-sm-10">
        <select name="tower_id" id="select-towers" class="form-control select2" data-placeholder="Torres">
            <option disabled selected></option>
        </select>
        <div id="tower-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div id="table" class="form-group row">
    <label for="type" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
        <h6 class="m-0 mb-2">Informe abaixo o(s) link(s) e/ou diretório(s) para esta apllicação</h6>
        <small id="error-msg" style="display: none;" class="text-danger">
            <i class="fas fa-exclamation-circle"></i>
            <b>AMBIENTE</b>, <b>TIPO</b>, <b>CONTEÚDO</b>, são de preenchimento obrigatorio.
        </small>
        <div class="content">
            <table id="application-details" class="table table-hover table-bordered table-sm">
                <thead>
                    <th style="width: 70px;">
                        <select name="is-empty" id="select-environments" class="form-control form-control-sm" placeholder="Ambiente">
                            <option disabled selected></option>
                        </select>
                    </th>
                    <th style="width: 90px;">
                        <select name="is-empty" class="location_type form-control form-control-sm" placeholder="select your beverage">
                            <option disabled selected></option>
                            <option value="Link">Link</option>
                            <option value="Diretório">Diretório</option>
                        </select>
                    </th>
                    <th><input class="form-control form-control-sm" name="is-empty" type="text" id="location_content" placeholder="Conteúdo"></th>
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

<div class="form-group row">
    <label for="server_id" class="col-sm-2 col-form-label">Servidores</label>
    <div class="col-sm-10">
        <select name="servers[]" id="select-servers" class="form-control select2" multiple="multiple" data-placeholder="Servidores"></select>
    </div>
</div>

<div class="form-group row">
    <label for="employee_id" class="col-sm-2 col-form-label">Usuários</label>
    <div class="col-sm-10">
        <select name="employees[]" id="select-users" class="form-control select2" multiple="multiple" data-placeholder="Usuários"
            style="width: 100%;">
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Descrição"></textarea>
    </div>
</div>
