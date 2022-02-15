<div class="table-responsive">
    

    <table class="table" id="recipes-table">
        <thead>
            <tr>
                 <th>
                     <form action="{{route("recipes.index")}}">
                     <input type="text" name="title" placeholder="@lang('models/recipes.fields.title')">
                     </form>
                    </th>
               
                <th>
                    <form action="{{route("recipes.index")}}">
                 <input type="text" name="user_id" placeholder=" @lang('models/recipes.fields.user_id')">
                    </form>
                </th>
                <th>
                    <form action="{{route("recipes.index")}}">
                 <input type="text" name="category_id" placeholder=" @lang('models/recipes.fields.category_id')">
                    </form>
                </th>
                <th>
                    <form action="{{route("recipes.index")}}">
                 <input type="text" name="people_count" placeholder="@lang('models/recipes.fields.people_count')">
                    </form>
                </th>
                <th>
                    <form action="{{route("recipes.index")}}">
                 <input type="text" name="cooking_time" placeholder="@lang('models/recipes.fields.cooking_time')">
                    </form>
                </th>
            </tr>
            <tr>

                <th>@lang('models/recipes.fields.title')</th>
                
                <th>@lang('models/recipes.fields.user_id')</th>
                <th>@lang('models/recipes.fields.category_id')</th>
                <th>@lang('models/recipes.fields.people_count')</th>
                <th>@lang('models/recipes.fields.cooking_time')</th>
                <th>@lang('models/recipes.fields.created_by')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($recipes as $recipe)
            <tr>
                <td>{{ $recipe->title }}</td>
                <td>{{ $recipe->user ? $recipe->user->name : "-" }}</td>
                <td>{{ app()->getLocale() == "en" ? $recipe->category->name_en : $recipe->category->name_ar}} </td>
                <td>{{ $recipe->people_count }}</td>
                <td>{{ $recipe->cooking_time->format("H:i") }}</td>
                <td>{{ $recipe->createdBy->full_name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['recipes.destroy', $recipe->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('recipes.show', [$recipe->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('recipes.edit', [$recipe->id]) }}" class='btn btn-default btn-xs'>
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