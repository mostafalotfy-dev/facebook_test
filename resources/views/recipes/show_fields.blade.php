<!-- View Count Field -->
<div class="col-sm-12">
    {!! Form::label('view_count', __('models/recipes.fields.view_count').':') !!}
    <p>{{ $recipe->view_count }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/recipes.fields.description').':') !!}
    <p>{{ $recipe->description }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/recipes.fields.user_id').':') !!}
    <p>{{ $recipe->user_id }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', __('models/recipes.fields.category_id').':') !!}
    <p>{{ $recipe->category_id }}</p>
</div>

<!-- People Count Field -->
<div class="col-sm-12">
    {!! Form::label('people_count', __('models/recipes.fields.people_count').':') !!}
    <p>{{ $recipe->people_count }}</p>
</div>

<!-- Cooking Time Field -->
<div class="col-sm-12">
    {!! Form::label('cooking_time', __('models/recipes.fields.cooking_time').':') !!}
    <p>{{ $recipe->cooking_time }}</p>
</div>

