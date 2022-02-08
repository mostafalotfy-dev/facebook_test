<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', __('models/hashTags.fields.title').':') !!}
    <p>{{ $hashTag->title }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('models/hashTags.fields.user_id').':') !!}
    <p>{{ $hashTag->user_id }}</p>
</div>

<!-- Postable Type Field -->
<div class="col-sm-12">
    {!! Form::label('postable_type', __('models/hashTags.fields.postable_type').':') !!}
    <p>{{ $hashTag->postable_type }}</p>
</div>

<!-- Postable Id Field -->
<div class="col-sm-12">
    {!! Form::label('postable_id', __('models/hashTags.fields.postable_id').':') !!}
    <p>{{ $hashTag->postable_id }}</p>
</div>

