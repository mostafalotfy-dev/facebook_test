<!-- Name Field -->
<div class="row">
    <div class="form-group col-sm-12">
        {!! Form::label('name', __('models/roles.fields.name').':') !!}
        {!! Form::text('name', null, ['class' => 'form-control',"required"=>"true","data-maxlength"=>30]) !!}
    </div>

  
</div>


<div class="clearfix"></div>

        <h3>@lang("models/permissions.plural")</h3>

<div class="clearfix"></div>

@foreach($groups as $g)

    <div class="form-group col-md-3">
        <h5>{{$g}}</h5>
        <div class="row">

            @foreach($permissions as $permission)

                @if(explode("-",$permission->name)[1] == $g)
                    <div class="col-md-12">
                    <input type="checkbox" name="roles[{{$permission->id}}]"
                           @if( $role->hasPermissionTo($permission->id)) checked
                           @endif
                           value="{{$permission->id}}"  @if($role->id == 1) disabled @endif id="{{$permission->name}}checkbox01"/>
                    <label for="{{$permission->name}}checkbox01">{{$permission->name}}</label>
                    </div>
                @endif

            @endforeach
        </div>

    </div>

@endforeach
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('roles.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

@push("scripts")
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
    @endpush

