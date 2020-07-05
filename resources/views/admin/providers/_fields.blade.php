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
    <label for="email" class="col-sm-2 col-form-label">Contatos</label>
    <div class="col-sm-10">
        <table id="providers_table" class="table table-bordered table-hover table-sm animated fadeIn">
            <thead>
                <tr>
                    <th>#</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Site</th>
                    <th class="myWidth"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>01@email.com</td>
                    <td>813333-4444</td>
                    <td>8199999-8888</td>
                    <td>www.fornecedor.com.br</td>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
    <label for="site" class="col-sm-2 col-form-label">Site</label>
    <div class="col-sm-10">
        <input type="text" id="site" name="site" class="form-control" placeholder="Site">
        <div id="site-feedback" class="invalid-feedback"></div>
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