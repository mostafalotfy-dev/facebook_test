<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/comics.fields.user_id').':') !!}
    <p>{{ $comic->user_id }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/comics.fields.description').':') !!}
    <p>{{ $comic->description }}</p>
</div>

