<input type="hidden" name="id" id="id">

<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" placeholder="Nome">
        <div id="name-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="type" id="type" class="form-control" placeholder="Tipo">
            <option disabled="disabled" selected="selected">Selecione um item</option>
            <option value="AO">AO</option>
            <option value="KEY">Usuário Chave</option>
            <option value="BO">BO</option>
        </select>
        <div id="type-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="tower_id" class="col-sm-2 col-form-label">Torres</label>
    <div class="col-sm-10">
        <select name="tower_id" id="select-tower" class="form-control" data-placeholder="Torres" style="width: 100%;">
            <option selected="selected" disabled="disabled">Selecione um item</option>
        </select>
        <div id="tower-feedback" class="invalid-feedback"></div>
    </div>
</div>