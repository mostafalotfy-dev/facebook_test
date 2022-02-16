
<div class="table-responsive">
    <table class="table col-md-6" id="recipes-table">
        <thead>
            
            <tr>

                <th>@lang('models/recipes.fields.title')</th>
                
                <th>@lang('models/recipes.fields.user_id')</th>
                <th>@lang('models/recipes.fields.category_id')</th>
             
                <th>@lang('models/recipes.fields.created_by')</th>
               
            </tr>
        </thead>
        <tbody>
            
           
            <tr>
               
                <td>{{ $recipe->title }}</td>
                <td>{{ $recipe->user ? $recipe->user->name : "-" }}</td>
                <td>{{ app()->getLocale() == "en" ? $recipe->category->name_en : $recipe->category->name_ar}} </td>
               
                <td>{{  $recipe->createdBy->full_name }}</td>
               
            </tr>
            
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table col-md-6" id="recipes-table">
        <thead>
            
            <tr>

                <th>@lang('models/users.fields.title')</th>
                
                <th>@lang('models/recipes.fields.user_id')</th>
                <th>@lang('models/recipes.fields.category_id')</th>
             
                <th>@lang('models/recipes.fields.created_by')</th>
               
            </tr>
        </thead>
        <tbody>
            
           
            <tr>
               
                <td>{{ $recipe->title }}</td>
                <td>{{ $recipe->user ? $recipe->user->name : "-" }}</td>
                <td>{{ app()->getLocale() == "en" ? $recipe->category->name_en : $recipe->category->name_ar}} </td>
               
                <td>{{  $recipe->createdBy->full_name }}</td>
               
            </tr>
            
        </tbody>
    </table>
</div>
