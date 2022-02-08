<div class="table-responsive">
    <table class="table" id="shortVideos-table">
        <thead>
        <tr>
            <th>@lang('models/shortVideos.fields.description')</th>
        <th>@lang('models/shortVideos.fields.view_count')</th>
        <th>@lang('models/shortVideos.fields.user_id')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($shortVideos as $shortVideo)
            <tr>
                <td>{{ $shortVideo->description }}</td>
            <td>{{ $shortVideo->view_count }}</td>
            <td>{{ $shortVideo->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['shortVideos.destroy', $shortVideo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('shortVideos.show', [$shortVideo->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('shortVideos.edit', [$shortVideo->id]) }}"
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
