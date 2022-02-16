<div class="table-responsive">
    <table class="table" id="admins-table">
        <thead>
        <tr>
            <th>@lang("models/admins.fields.id")</th>
        <th>@lang('models/admins.fields.full_name')</th>
        <th>@lang('models/admins.fields.email')</th>
        <th>@lang('models/admins.fields.avatar')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($admins as $admin)
        <tr>    
            <td><a href="{{route('admins.show',$admin->id)}}">{{$loop->index + 1}}</a></td>
            <td>{{ $admin->full_name }}</td>
            <td>{{ $admin->email }}</td>
            <td><img src="{{ asset("storage/$admin->avatar") }}" alt=""></td>
                <td width="120">
                    {!! Form::open(['route' => ['admins.destroy', $admin->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admins.show', [$admin->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admins.edit', [$admin->id]) }}"
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
    {{$admins->links()}}
</div>
