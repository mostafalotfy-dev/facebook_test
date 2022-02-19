@inject('category', 'App\Models\Category')


<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/comics.fields.category_id').':') !!}
    {{Form::select("category_id",$category->all()->pluck("name_".app()->getLocale(),"id"),null,["class"=>"form-control"])}}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/comics.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>



<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/comics.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('media', __('models/comics.fields.media').':') !!}
    {!! Form::file('media[]', ['class' => 'form-control',"accept"=>"image/*,video/*","max"=>50000,"multiple"=>true]) !!}

</div>
@push("page_scripts")
<script>
    $("#user_id").select2({
        ajax:{
            url:"{{route('users.ajax')}}",
        }
    })
    </script>
@endpush