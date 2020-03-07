{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $id]]) !!}
<a href="{{ route('users.edit', $id) }}" class="btn btn-xs btn-default">
    <i class="fas fa-edit"></i>
</a>
{!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-default btn-xs fas fa-trash-alt'] ) !!}
{!! Form::close() !!}