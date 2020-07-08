<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" placeholder="Nome">
        <div id="name-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="opening_hours" class="col-sm-2 col-form-label">Atendimento</label>
    <div class="col-sm-10">
        <input type="text" name="opening_hours" id="opening_hours" class="form-control" placeholder="Horario de Atendimento">
        <div id="opening_hours-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="on_duty" class="col-sm-2 col-form-label">Plantão</label>
    <div class="col-sm-10">
        <select name="on_duty" id="on_duty" class="form-control select2" data-placeholder="Plantão">
            <option disabled selected></option>
            <option value="-">N/A</option>
            <option value="12/7">12/07</option>
            <option value="24/7">24/07</option>
        </select>
        <div id="on_duty-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrição"></textarea>
    </div>
</div>