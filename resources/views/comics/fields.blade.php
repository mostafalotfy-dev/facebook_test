<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/comics.fields.user_id').':') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/comics.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>