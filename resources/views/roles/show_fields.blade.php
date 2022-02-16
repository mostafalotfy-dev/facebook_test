<!-- Name Field -->
<div class="form-group">
    <strong>{{ __('models/roles.fields.name') }}</strong>
    <p>{{ $role->name }}</p>
</div>


{{-- <!-- Description Field -->
<div class="form-group">
    <strong>{{  __('models/roles.fields.description_en') }}</strong>
    <p>{{ $role->description_en ?: "-" }}</p>
</div>
<div class="form-group">
    <strong>{{__('models/roles.fields.description_ar')}}</strong>
    <p>{{ $role->description_ar ?: "-" }}</p>
</div> --}}



<!-- Created At Field -->
{{-- <div class="form-group">
    <strong>{{  __('models/roles.fields.created_at') }}</strong>
    <p>{{ $role->created_at->format("Y-m-d") }}</p>
</div> --}}
<div class="container">
<div class="row">
    <h3> @lang("models/permissions.plural")</h3>

</div>
</div>
    <div class="form-group ">
        <div class="row">
            @foreach($role->permissions as $permission)

                <div class="col-md-12">
                    <li for="{{$permission->name}}checkbox01">{{$permission->name}}</li>
                </div>
            @endforeach
        </div>
</div>
@php($user = $recipe->user)
<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
        <th>@lang('models/users.fields.name')</th>
        <th>@lang('models/users.fields.phone_number')</th>
   

        <th>@lang('models/users.fields.avatar')</th>
 
        <th>@lang('models/users.fields.description')</th>
   
        <th colspan="3">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
     
            <tr>
                <td>{{ $user->name }}</td>
            <td>{{ $user->phone_number }}</td>
            
    
            <td> <img src="{{  asset("storage/".$user->avatar )}}" alt=""> </td>
            <td>{{ $user->description }}</td>
            
                <td width="120">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('users.show', [$user->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('users.edit', [$user->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
       
        </tbody>
    </table>
 
</div>


