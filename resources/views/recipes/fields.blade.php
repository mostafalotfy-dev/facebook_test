<!-- View Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('view_count', __('models/recipes.fields.view_count').':') !!}
    {!! Form::number('view_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/recipes.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/recipes.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/recipes.fields.user_id').':') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/recipes.fields.category_id').':') !!}
    {!! Form::number('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- People Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('people_count', __('models/recipes.fields.people_count').':') !!}
    {!! Form::number('people_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Cooking Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cooking_time', __('models/recipes.fields.cooking_time').':') !!}
    {!! Form::text('cooking_time', null, ['class' => 'form-control','id'=>'cooking_time']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#cooking_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush