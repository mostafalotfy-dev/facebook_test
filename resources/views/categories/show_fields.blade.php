<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', __('models/categories.fields.name_en').':') !!}
    <p>{{ $category->name_en }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/categories.fields.name_ar').':') !!}
    <p>{{ $category->name_ar }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/categories.fields.image').':') !!}
    <p>{{ $category->image }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', __('models/categories.fields.created_by').':') !!}
    <p>{{ $category->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('updated_by', __('models/categories.fields.updated_by').':') !!}
    <p>{{ $category->updated_by }}</p>
</div>

