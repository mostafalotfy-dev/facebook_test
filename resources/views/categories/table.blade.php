<div class="table-responsive">
    <table class="table" id="categories-table">
        <thead>
        <tr>
            <th>@lang('models/categories.fields.name_en')</th>
        <th>@lang('models/categories.fields.name_ar')</th>
        <th>@lang('models/categories.fields.image')</th>
        <th>@lang('models/categories.fields.created_by')</th>
        <th>@lang('models/categories.fields.updated_by')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($categories as $category)
            <tr>
                <td>{{ $category->name_en }}</td>
            <td>{{ $category->name_ar }}</td>
            <td>{{ $category->image }}</td>
            <td>{{ $category->created_by }}</td>
            <td>{{ $category->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('categories.show', [$category->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('categories.edit', [$category->id]) }}"
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
