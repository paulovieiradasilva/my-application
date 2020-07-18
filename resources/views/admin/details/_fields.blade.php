<div class="form-group row">
    <label for="application_id" class="col-sm-2 col-form-label">Aplicações</label>
    <div class="col-sm-10">
        <select name="application_id" id="select-applications" class="form-control select2" data-placeholder="Aplicações">
            <option disabled selected></option>
        </select>
        <div id="application-feedback" class="invalid-feedback"></div>
    </div>
</div>

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
    <label for="type" class="col-sm-2 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="type" id="type" class="form-control select2" data-placeholder="Tipo">
            <option disabled selected></option>
            <option value="Link">Link</option>
            <option value="Diretório">Diretório</option>
        </select>
        <div id="type-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="content" class="col-sm-2 col-form-label">Conteúdo</label>
    <div class="col-sm-10">
        <input type="text" id="content" name="content" class="form-control" placeholder="Conteúdo">
        <div id="content-feedback" class="invalid-feedback"></div>
    </div>
</div>