<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/recipes.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/recipes.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', __('models/recipes.fields.category_id').':') !!}
    {!! Form::select('category_id',$categories,null, ['class' => 'form-control']) !!}
</div>

<!-- People Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('people_count', __('models/recipes.fields.people_count').':') !!}
    {!! Form::number('people_count', null, ['class' => 'form-control',"min"=>1]) !!}
</div>

<!-- Cooking Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cooking_time', __('models/recipes.fields.cooking_time').':') !!}
    {!! Form::text('cooking_time', null, ['class' => 'form-control','id'=>'cooking_time']) !!}
</div>
  <!--  Hashtag Field -->
  <div class="form-group col-sm-6">
    {!! Form::label('hashtag', "Selected Hash Is ".$recipe->hashtag->title.':') !!}
    {!! Form::select('hash_tag_id',[], null, ['id'=>'hashtag',"class"=>"select2 hashtags form-control"]) !!}
</div>

@if(isset($recipe) && $recipe->ingredients)
<!-- i@dngredinets Time Field -->

<div class="form-group col-sm-6">
    {!! Form::label('ingredients', __('models/ingredients.plural').':') !!}
    {!! Form::text('ingredients', $recipe->ingredients->implode("description",","), ['id'=>'ingredients',"class"=>"tagify"]) !!}
</div>
@else
<div class="form-group col-sm-6">
    {!! Form::label('ingredients', __('models/ingredients.plural').':') !!}
    {!! Form::text('ingredients',null, ['id'=>'ingredients',"class"=>"tagify"]) !!}
</div>

@endif

@if(isset($recipe) && $recipe->steps)
<div class="form-group col-sm-6">
    {!! Form::label('steps', __('models/steps.plural').':') !!}
    {!! Form::text('steps', $recipe->steps->implode("step_description",","), ['id'=>'steps',"class"=>"tagify"]) !!}
</div>
@else

<div class="form-group col-sm-6">
    {!! Form::label('steps', __('models/steps.plural').':') !!}
    {!! Form::text('steps',null, ['id'=>'steps',"class"=>"tagify"]) !!}
</div>
@endif
@push('page_scripts')
    <script type="text/javascript">
        $('#cooking_time').datetimepicker({
            format: 'hh:mm',
            useCurrent: true,
            sideBySide: true
        })
        !function(){
            $("#hashtag").select2({
                ajax:{
                    url:"{{route('hashtags.ajax')}}",
                   
                }
            })
            $("#hashtag").trigger("select2:open")
        }()
    </script>
@endpush