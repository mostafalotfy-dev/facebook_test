<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/comics.fields.user_id').':') !!}
    <p>{{ $comic->user_id }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', __('models/comics.fields.category_id').':') !!}
    <p>{{ $comic->category_id }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', __('models/comics.fields.title').':') !!}
    <p>{{ $comic->title }}</p>
</div>

<!-- Is Active Field -->
<div class="col-sm-12">
    {!! Form::label('is_active', __('models/comics.fields.is_active').':') !!}
    <p>{{ $comic->is_active }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/comics.fields.description').':') !!}
    <p>{{ $comic->description }}</p>
</div>

