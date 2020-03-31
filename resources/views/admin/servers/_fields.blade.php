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

<div class="form-group row">
    <label for="environment_id" class="col-sm-2 col-form-label">Ambientes</label>
    <div class="col-sm-10">
        <select name="environment_id" id="select-environment" class="form-control" data-placeholder="Ambientes"
            style="width: 100%;">
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