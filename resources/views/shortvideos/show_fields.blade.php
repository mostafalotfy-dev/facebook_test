<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/shortvideos.fields.description').':') !!}
    <p>{{ $shortvideo->description }}</p>
</div>

<!-- File Name Field -->
<div class="col-sm-12">
    {!! Form::label('file_name', __('models/shortvideos.fields.file_name').':') !!}
    <p>{{ $shortvideo->file_name }}</p>
</div>

<!-- View Count Field -->
<div class="col-sm-12">
    {!! Form::label('view_count', __('models/shortvideos.fields.view_count').':') !!}
    <p>{{ $shortvideo->view_count }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/shortvideos.fields.user_id').':') !!}
    <p>{{ $shortvideo->user_id }}</p>
</div>

