<div class="table-responsive">
    <table class="table" id="replies-table">
        <thead>
        <tr>
            <th>@lang('models/roles.fields.id')</th>
        <th>@lang('models/roles.fields.name')</th>
        <th>@lang('models/roles.fields.users_count')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($roles as $role)
            <tr>
                <td><a href="{{route('roles.show',$role->id)}}">{{ $loop->index +1 }}</a></td>
            <td>{{ $role->name }}</td>
            <td><a href="{{route("roles.admins",["role"=>$role->id])}}">{{ $role->users()->count() }}</a></td>
                <td width="120">
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('roles.show', [$role->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('roles.edit', [$role->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
    {{$roles->links()}}
</div>
