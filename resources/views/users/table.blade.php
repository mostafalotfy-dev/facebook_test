<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>@lang('models/users.fields.name')</th>
        <th>@lang('models/users.fields.phone_number')</th>
   

        <th>@lang('models/users.fields.avatar')</th>
 
        <th>@lang('models/users.fields.description')</th>
   
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
            <td>{{ $user->phone_number }}</td>
            
            
    
            <td> <img src="{{  asset("storage/".$user->avatar )}}" alt=""> </td>
            <td>{{ $user->description }}</td>
            
                <td width="120">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('users.show', [$user->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('users.edit', [$user->id]) }}"
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
    {{$users->links()}}
</div>
