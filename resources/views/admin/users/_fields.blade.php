<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" placeholder="Nome">
        <div id="name-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="slug" class="col-sm-2 col-form-label">E-mail</label>
    <div class="col-sm-10">
        <input type="text" name="email" id="email" class="form-control" placeholder="E-mail">
        <div id="email-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Papéis</label>
    <div class="col-sm-10">
        <select name="roles[]" id="select-roles" class="form-control select2" multiple="multiple"
            data-placeholder="Papéis" style="width: 100%;">
        </select>
    </div>
</div>

<div class="form-group row password">
    <label for="slug" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <div id="password-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row password-confirm">
    <label for="slug" class="col-sm-2 col-form-label">Confirmar</label>
    <div class="col-sm-10">
        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Confirmar Password">
        <div id="password-confirm-feedback" class="invalid-feedback"></div>
    </div>
</div>