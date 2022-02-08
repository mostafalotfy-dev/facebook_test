<div class="table-responsive">
    <table class="table" id="followings-table">
        <thead>
        <tr>
            <th>@lang('models/followings.fields.user_id')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($followings as $following)
            <tr>
                <td>{{ $following->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['followings.destroy', $following->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('followings.show', [$following->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('followings.edit', [$following->id]) }}"
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
</div>
