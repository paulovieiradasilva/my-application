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
        <input type="text" id="ip" name="ip" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask im-insert="true" placeholder="IP">
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
        <select name="type" id="type" class="form-control select2" data-placeholder="Tipo">
            <option disabled selected></option>
            <option value="Aplicação">Aplicação</option>
            <option value="Banco de Dados">Banco de Dados</option>
        </select>
        <div id="type-feedback" class="invalid-feedback"></div>
    </div>
</div>

@include('admin.servers._database')

<div class="form-group row">
    <label for="environment_id" class="col-sm-2 col-form-label">Ambiente</label>
    <div class="col-sm-10">
        <select name="environment_id" id="select-environments" class="form-control select2" data-placeholder="Ambiente">
            <option disabled selected></option>
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
