<div class="table-responsive">
    <table class="table" id="shortvideos-table">
        <thead>
        <tr>
            <th>@lang('models/shortvideos.fields.description')</th>
        <th>@lang('models/shortvideos.fields.file_name')</th>
        <th>@lang('models/shortvideos.fields.view_count')</th>
        <th>@lang('models/shortvideos.fields.user_id')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($shortvideos as $shortvideo)
            <tr>
                <td>{{ $shortvideo->description }}</td>
            <td>{{ $shortvideo->file_name }}</td>
            <td>{{ $shortvideo->view_count }}</td>
            <td>{{ $shortvideo->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['shortvideos.destroy', $shortvideo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('shortvideos.show', [$shortvideo->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('shortvideos.edit', [$shortvideo->id]) }}"
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
