
<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', __('models/recipes.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/recipes.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/recipes.fields.category_id').':') !!}
    {!! Form::select('category_id', $categories,null, ['class' => 'form-control']) !!}
</div>

<!-- People Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('people_count', __('models/recipes.fields.people_count').':') !!}
    {!! Form::number('people_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Cooking Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cooking_time', __('models/recipes.fields.cooking_time').':') !!}
    {!! Form::text('cooking_time', null, ['class' => 'form-control','id'=>'cooking_time']) !!}
</div>
<div class="container col-md-6">
<div class="cloneable form-group">
    <div class="col-md-6">
    {!!Form::label("ingredients",__("models/recipes.field.ingredients"))!!}
    
    {!!Form::number("count[]",null,["class"=>"form-control"])!!}
</div>
{!!Form::text('ingredients[]',null,["class"=>"form-control"])!!}
    <button type="button" class="add-clone">Add</button>
    <button type="button" class="remove-clone">Remove</button>
</div>
</div>
@push('page_scripts')
    <script type="text/javascript">
        $('#cooking_time').datetimepicker({
            format: 'HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        });
        $(document).on("click",'.add-clone',function(e)
        {
            e.preventDefault();
            var clone = $(".cloneable").eq(0).clone();
            clone.find(":input").val(" ")
            var cloneCount = $(".cloneable").length;
            if(cloneCount > 1)
            {
                 
            }
        $(".container").append(clone)
        })
        $(document).on("click",".remove-clone",function(e){
            e.preventDefault();
            var cloneCount = $(".cloneable").length;
            if(cloneCount > 1)
            {
                $(this).parent().remove()
            }
            
        })
       
    </script>
@endpush