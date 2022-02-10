<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Phone Number Field -->
<div class="col-sm-12">
    {!! Form::label('phone_number', __('models/users.fields.phone_number').':') !!}
    <p>{{ $user->phone_number }}</p>
</div>

<!-- Phone Number Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('phone_number_verified_at', __('models/users.fields.phone_number_verified_at').':') !!}
    <p>{{ $user->phone_number_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Verify Number Field -->
<div class="col-sm-12">
    {!! Form::label('verify_number', __('models/users.fields.verify_number').':') !!}
    <p>{{ $user->verify_number }}</p>
</div>

<!-- Avatar Field -->
<div class="col-sm-12">
    {!! Form::label('avatar', __('models/users.fields.avatar').':') !!}
    <p>{{ $user->avatar }}</p>
</div>

<!-- Provider Id Field -->
<div class="col-sm-12">
    {!! Form::label('provider_id', __('models/users.fields.provider_id').':') !!}
    <p>{{ $user->provider_id }}</p>
</div>

<!-- Provider Token Field -->
<div class="col-sm-12">
    {!! Form::label('provider_token', __('models/users.fields.provider_token').':') !!}
    <p>{{ $user->provider_token }}</p>
</div>

<!-- Provider Name Field -->
<div class="col-sm-12">
    {!! Form::label('provider_name', __('models/users.fields.provider_name').':') !!}
    <p>{{ $user->provider_name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/users.fields.description').':') !!}
    <p>{{ $user->description }}</p>
</div>

<!-- User Ip Field -->
<div class="col-sm-12">
    {!! Form::label('user_ip', __('models/users.fields.user_ip').':') !!}
    <p>{{ $user->user_ip }}</p>
</div>

<!-- Remember Token Field -->
<div class="col-sm-12">
    {!! Form::label('remember_token', __('models/users.fields.remember_token').':') !!}
    <p>{{ $user->remember_token }}</p>
</div>

