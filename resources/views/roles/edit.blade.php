@extends('layouts.app')
@section('title')
Roles
@endsection
@section('heading')
    @lang('models/roles.singular')
@endsection
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                 @lang('models/replies.singular')
            </div>
        </div>
    </div>
</section>
<div class="content px-3 py-3">

    @include('adminlte-templates::common.errors')
<div class="card py-3 px-3">
    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch',"data-validate"=>"validator"]) !!}

        @include('roles.fields')

    {!! Form::close() !!}

</div>
@endsection
@push("scripts")
   <script>

        $("select").select2({
            placeholder: "{{__("models/permissions.plural")}}"
        })

    </script>

@endpush
