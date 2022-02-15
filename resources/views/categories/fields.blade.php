<!-- Name En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', __('models/categories.fields.name_en').':') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Name Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_ar', __('models/categories.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', __('models/categories.fields.image').':') !!}
    {!! Form::file('image', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
   
</div> 
@if(isset($category))

<img width="150" src="{{asset("storage/$category->image")}}">
@endif