<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" placeholder="Nome">
        <div id="name-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
    <div class="col-sm-10">
        <input type="text" id="slug" name="slug" class="form-control" placeholder="Slug">
        <div id="slug-feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Descrição"></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Permissões</label>
    <div class="col-sm-10">
        <select name="permissions[]" id="select-permission" class="form-control select2" multiple="multiple"
            data-placeholder="Permissões" style="width: 100%;">
        </select>
    </div>
</div>