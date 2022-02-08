<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/cheifs.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', __('models/cheifs.fields.phone_number').':') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/cheifs.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Number Verified At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number_verified_at', __('models/cheifs.fields.phone_number_verified_at').':') !!}
    {!! Form::text('phone_number_verified_at', null, ['class' => 'form-control','id'=>'phone_number_verified_at']) !!}
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
    {!! Form::label('password', __('models/cheifs.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', __('models/cheifs.fields.avatar').':') !!}
    {!! Form::text('avatar', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Provider Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_id', __('models/cheifs.fields.provider_id').':') !!}
    {!! Form::number('provider_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Provider Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_token', __('models/cheifs.fields.provider_token').':') !!}
    {!! Form::text('provider_token', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Provider Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_name', __('models/cheifs.fields.provider_name').':') !!}
    {!! Form::text('provider_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Identity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('identity', __('models/cheifs.fields.identity').':') !!}
    {!! Form::text('identity', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Youtube Channel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('youtube_channel', __('models/cheifs.fields.youtube_channel').':') !!}
    {!! Form::text('youtube_channel', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Facebook Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facebook_link', __('models/cheifs.fields.facebook_link').':') !!}
    {!! Form::text('facebook_link', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/cheifs.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- User Ip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_ip', __('models/cheifs.fields.user_ip').':') !!}
    {!! Form::text('user_ip', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Udid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('udid', __('models/cheifs.fields.udid').':') !!}
    {!! Form::text('udid', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', __('models/cheifs.fields.remember_token').':') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>