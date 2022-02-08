<div class="table-responsive">
    <table class="table" id="hashTags-table">
        <thead>
        <tr>
            <th>@lang('models/hashTags.fields.title')</th>
        <th>@lang('models/hashTags.fields.user_id')</th>
        <th>@lang('models/hashTags.fields.postable_type')</th>
        <th>@lang('models/hashTags.fields.postable_id')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($hashTags as $hashTag)
            <tr>
                <td>{{ $hashTag->title }}</td>
            <td>{{ $hashTag->user_id }}</td>
            <td>{{ $hashTag->postable_type }}</td>
            <td>{{ $hashTag->postable_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['hashTags.destroy', $hashTag->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('hashTags.show', [$hashTag->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('hashTags.edit', [$hashTag->id]) }}"
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
