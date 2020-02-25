{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $id]]) !!}
    <a href="{{ route('users.edit', $id) }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
    {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs glyphicon glyphicon-trash'] ) !!}
{!! Form::close() !!}