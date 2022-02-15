<div class="table-responsive">
    <table class="table" id="comics-table">
        <thead>
        <tr>
            <th>@lang('models/comics.fields.user_id')</th>
        <th>@lang('models/comics.fields.category_id')</th>
        <th>@lang('models/comics.fields.title')</th>
        <th>@lang('models/comics.fields.is_active')</th>
        <th>@lang('models/comics.fields.description')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($comics as $comic)
            <tr>
                <td>{{ $comic->user_id }}</td>
            <td>{{ $comic->category_id }}</td>
            <td>{{ $comic->title }}</td>
            <td>{{ $comic->is_active }}</td>
            <td>{{ $comic->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['comics.destroy', $comic->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('comics.show', [$comic->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('comics.edit', [$comic->id]) }}"
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
