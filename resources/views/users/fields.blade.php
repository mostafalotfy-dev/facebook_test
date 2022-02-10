<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', __('models/users.fields.phone_number').':') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>



@push('page_scripts')
    <script type="text/javascript">
        $('#phone_number_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>



<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', __('models/users.fields.avatar').':') !!}
    {!! Form::file('avatar', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>






<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/users.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

