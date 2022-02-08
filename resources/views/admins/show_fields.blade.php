<!-- First Name Field -->
<div class="col-sm-12">
    {!! Form::label('first_name', __('models/admins.fields.first_name').':') !!}
    <p>{{ $admin->first_name }}</p>
</div>

<!-- Last Name Field -->
<div class="col-sm-12">
    {!! Form::label('last_name', __('models/admins.fields.last_name').':') !!}
    <p>{{ $admin->last_name }}</p>
</div>

<!-- Full Name Field -->
<div class="col-sm-12">
    {!! Form::label('full_name', __('models/admins.fields.full_name').':') !!}
    <p>{{ $admin->full_name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    <p>{{ $admin->email }}</p>
</div>

<!-- Avatar Field -->
<div class="col-sm-12">
    {!! Form::label('avatar', __('models/admins.fields.avatar').':') !!}
    <p>{{ $admin->avatar }}</p>
</div>

