
<div class="table-responsive col-md-6">
    <table class="table " id="recipes-table">
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
<div class="table-responsive col-md-6">
    <table class="table " id="recipes-table">
        <thead>
            
            <tr>

                <th>@lang('models/users.fields.name')</th>
                
                <th>@lang('models/recipes.fields.user_id')</th>
                <th>@lang('models/recipes.fields.category_id')</th>
             
                <th>@lang('models/recipes.fields.created_by')</th>
               
            </tr>
        </thead>
        <tbody>
            
           
            <tr>
               @php ($user= $recipe->user ? $recipe->user : null)
               @php($admin = $recipe->createdBy ? $recipe->createdBy : null)
                <td>{{ $recipe->title }}</td>
                <td><a href="{{$user ? route("users.show",$recipe->user->id) : "#"}}">{{ $user ? $user->name : "-" }}</a></td>
                <td>{{ app()->getLocale() == "en" ? $recipe->category->name_en : $recipe->category->name_ar}} </td>
               
                <td><a href="{{route("admins.show",$admin->id)}}">{{  $admin->full_name }}</a></td>
               
            </tr>
            
        </tbody>
    </table>
</div>
