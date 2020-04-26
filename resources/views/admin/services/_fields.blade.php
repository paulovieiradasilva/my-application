<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" placeholder="Nome">
        <div id="name-feedback" class="invalid-feedback"></div>
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
    <label for="application_id" class="col-sm-2 col-form-label">Aplicações</label>
    <div class="col-sm-10">
        <select name="application_id" id="select-applications" class="form-control select2" data-placeholder="Aplicações">
            <option disabled selected></option>
        </select>
        <div id="application-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrição"></textarea>
    </div>
</div>