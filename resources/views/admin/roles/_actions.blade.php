{!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $id]]) !!}
<a href="{{ route('roles.edit', $id) }}" class="btn btn-xs btn-default">
    <i class="fas fa-edit"></i>
</a>
{!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs fas fa-trash-alt'] ) !!}
{!! Form::close() !!}