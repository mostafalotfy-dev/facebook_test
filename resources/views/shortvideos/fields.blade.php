<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/shortvideos.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- File Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_name', __('models/shortvideos.fields.file_name').':') !!}
    {!! Form::file('file_name',  ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- View Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('view_count', __('models/shortvideos.fields.view_count').':') !!}
    {!! Form::number('view_count', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/shortvideos.fields.user_id').':') !!}
    {!! Form::select('user_id',[], null, ['class' => 'form-control']) !!}
</div>
@push("page_scripts")
<script>
    $("#user_id").select2({
        ajax:{
            method:"post",
            url:"{{route('users.ajax')}}",
            method:"get"
        }
    })
</script>
@endpush