<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/shortVideos.fields.description').':') !!}
    <p>{{ $shortVideo->description }}</p>
</div>

<!-- View Count Field -->
<div class="col-sm-12">
    {!! Form::label('view_count', __('models/shortVideos.fields.view_count').':') !!}
    <p>{{ $shortVideo->view_count }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/shortVideos.fields.user_id').':') !!}
    <p>{{ $shortVideo->user_id }}</p>
</div>

