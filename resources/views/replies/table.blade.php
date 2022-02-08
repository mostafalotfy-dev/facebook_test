<div class="table-responsive">
    <table class="table" id="replies-table">
        <thead>
        <tr>
            <th>@lang('models/replies.fields.user_id')</th>
        <th>@lang('models/replies.fields.comment_id')</th>
        <th>@lang('models/replies.fields.description')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($replies as $reply)
            <tr>
                <td>{{ $reply->user_id }}</td>
            <td>{{ $reply->comment_id }}</td>
            <td>{{ $reply->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['replies.destroy', $reply->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('replies.show', [$reply->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('replies.edit', [$reply->id]) }}"
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
