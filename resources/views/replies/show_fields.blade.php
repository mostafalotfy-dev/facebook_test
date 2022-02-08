<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/replies.fields.user_id').':') !!}
    <p>{{ $reply->user_id }}</p>
</div>

<!-- Comment Id Field -->
<div class="col-sm-12">
    {!! Form::label('comment_id', __('models/replies.fields.comment_id').':') !!}
    <p>{{ $reply->comment_id }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/replies.fields.description').':') !!}
    <p>{{ $reply->description }}</p>
</div>

