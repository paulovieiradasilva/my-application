<fieldset class="form-group">
    <div class="row">
        <label for="provider_id" class="col-sm-2 col-form-label">Tipo</label>
        <div class="col-sm-10 d-flex">
            <div class="form-check mr-4 mt-2">
                <input class="form-check-input" type="radio" id="1" name="contactable_type" value="App\Models\Employee">
                <label class="form-check-label" for="gridRadios1">
                    Funcionário
                </label>
            </div>
            <div class="form-check mr-4 mt-2">
                <input class="form-check-input" type="radio" id="2" name="contactable_type" value="App\Models\Provider">
                <label class="form-check-label" for="gridRadios2">
                    Fornecedor
                </label>
            </div>
        </div>
    </div>
</fieldset>

<div class="form-group row type-employee-box" style="display: none;">
    <label for="employee_id" class="col-sm-2 col-form-label">Funcionários</label>
    <div class="col-sm-10">
        <select name="contactable_id" id="select-users" class="form-control select2" data-placeholder="Funcionários" style="width: 100%;"></select>
        <div id="users-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row type-provider-box" style="display: none;">
    <label for="provider_id" class="col-sm-2 col-form-label">Fornecedores</label>
    <div class="col-sm-10">
        <select name="contactable_id" id="select-providers" class="form-control select2" data-placeholder="Fornecedores"></select>
        <div id="providers-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row type-provider-box" style="display: none;">
    <label for="site" class="col-sm-2 col-form-label">Site</label>
    <div class="col-sm-10">
        <input type="text" id="site" name="site" class="form-control" placeholder="Site">
        <div id="site-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
    <div class="col-sm-10">
        <input type="text" id="email" name="email" class="form-control" placeholder="E-mail">
        <div id="email-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-sm-2 col-form-label">Telefone</label>
    <div class="col-sm-10">
        <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefone" data-inputmask='"mask": "(99) 9999-9999"' data-mask>
        <div id="phone-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="cellphone" class="col-sm-2 col-form-label">Celular</label>
    <div class="col-sm-10">
        <input type="text" id="cellphone" name="cellphone" class="form-control" placeholder="Celular" data-inputmask='"mask": "(99) 9 9999-9999"' data-mask>
        <div id="cellphone-feedback" class="invalid-feedback"></div>
    </div>
</div>