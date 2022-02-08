<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/hashTags.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/hashTags.fields.user_id').':') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Postable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postable_type', __('models/hashTags.fields.postable_type').':') !!}
    {!! Form::text('postable_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Postable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postable_id', __('models/hashTags.fields.postable_id').':') !!}
    {!! Form::number('postable_id', null, ['class' => 'form-control']) !!}
</div>