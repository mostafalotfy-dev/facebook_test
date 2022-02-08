<div class="table-responsive">
    <table class="table" id="recipes-table">
        <thead>
        <tr>
            <th>@lang('models/recipes.fields.view_count')</th>
        <th>@lang('models/recipes.fields.description')</th>
        <th>@lang('models/recipes.fields.user_id')</th>
        <th>@lang('models/recipes.fields.category_id')</th>
        <th>@lang('models/recipes.fields.people_count')</th>
        <th>@lang('models/recipes.fields.cooking_time')</th>
            <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($recipes as $recipe)
            <tr>
                <td>{{ $recipe->view_count }}</td>
            <td>{{ $recipe->description }}</td>
            <td>{{ $recipe->user->name }}</td>
            <td>{{ $recipe->category_id }}</td>
            <td>{{ $recipe->people_count }}</td>
            <td>{{ $recipe->cooking_time }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['recipes.destroy', $recipe->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('recipes.show', [$recipe->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('recipes.edit', [$recipe->id]) }}"
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
    {{$recipes->links()}}
</div>