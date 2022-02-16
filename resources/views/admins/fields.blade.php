@inject("roles","App\Models\Role")
<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', __('models/admins.fields.first_name').':') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', __('models/admins.fields.last_name').':') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>



<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/admins.fields.password').':') !!}
    {!! Form::password('password',  ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', __('models/admins.fields.role_id').':') !!}
    {!! Form::select('role_id', $roles->get()->pluck("name","id") ,null , ['class' => 'form-control']) !!}
</div>
<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', __('models/admins.fields.avatar').':') !!}
    {!! Form::file('avatar') !!}
</div>
