<button type="button" disabled onclick="edit({{ $id }})" class="btn btn-xs btn-default animated fadeIn">
    <i class="fa fa-info-circle"></i>
</button>

<button type="button" onclick="edit({{ $id }})" class="btn btn-xs btn-default animated fadeIn">
    <i class="fas fa-edit"></i>
</button>

<button type="button" onclick="confirmation({{ $id }})" class="btn btn-danger btn-xs animated fadeIn">
    <i class="fas fa-trash"></i>
</button>