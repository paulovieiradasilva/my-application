{!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $id]]) !!}
<a href="{{ route('permissions.edit', $id) }}" class="btn btn-xs btn-default">
    <i class="fas fa-edit"></i>
</a>
{!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs fas fa-trash-alt'] ) !!}
{!! Form::close() !!}