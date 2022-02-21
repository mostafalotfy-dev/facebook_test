<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/banners.fields.image').':') !!}
    <p>{{ $banner->image }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/banners.fields.created_at').':') !!}
    <p>{{ $banner->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/banners.fields.updated_at').':') !!}
    <p>{{ $banner->updated_at }}</p>
</div>

