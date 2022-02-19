<!-- User Id Field -->

<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/comics.fields.user_id').':') !!}
    {{$comic->user->name}}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/comics.fields.category_id').':') !!}
    {{$comic->category["name_".app()->getLocale()]}}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/comics.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>



<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/comics.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>