@extends('layouts.app')
@section('title')
Roles
@endsection
@section('title')
    @lang('models/roles.singular')
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('models/roles.singular')</h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    @include('roles.show_fields')
                </div>
               
                <a href="{{ route('roles.edit', $role->id) }}" class='btn button-gray'>
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                    </div>
                </div>
             </div>
   
</section>
@endsection
