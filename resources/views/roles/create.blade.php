@extends('layouts.app')
@section('title')
    Roles
@endsection
@section('heading')
    @lang('models/roles.singular')
@endsection
@section('content')
<div class="content px-3">
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

    <div class="card">
    
        @include('adminlte-templates::common.errors')

        {!! Form::open(['route' => 'roles.store', 'id' => 'admin', 'data-validate' => 'validator']) !!}


        <!-- Name Field -->
        <div class="form-group col-sm-12">

            {!! Form::text('name', null, ['class' => 'form-control', 'data-error' => __('validation.required', ['attribute' => __('models/roles.fields.name')]), 'data-maxlength' => 30, 'placeholder' => __('models/roles.fields.name') . ':']) !!}
        </div>


        <!-- Description Field -->
        <div class="form-group col-sm-6 col-lg-6">


            <textarea class="form-control form-control-border" style="height:none;" name="description_en" placeholder="{{ __('models/roles.fields.description_en') }}"></textarea>
        </div>
        <!-- Description Field -->
        <div class="form-group col-sm-6 col-lg-6">

            <textarea class="form-control form-control-border" style="height:none;" name="description_ar" placeholder="{{ __('models/roles.fields.description_ar') }}"></textarea>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="">
        <div class="panel-heading">
            <h3>@lang("models/permissions.plural")</h3>
            {{-- <input type="checkbox" id="checkAll"> Check All --}}
        </div>

    </div>

    @foreach ($groups as $g)

        <div class="form-group col-md-3">
            <h5>{{ $g }}</h5>
            <div class="row">

                @foreach ($permissions as $permission)

                    @if (explode('-', $permission->name)[1] == $g)
                        <div class="col-md-12">
                            <input type="checkbox" name="roles[{{ $permission->id }}]" value="{{ $permission->id }}" @if (old('roles.' . $permission->id)) checked @endif id="{{ $permission->name }}checkbox01" />
                            <label for="{{ $permission->name }}checkbox01">{{ $permission->name }}</label>
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



    {!! Form::close() !!}
    </div></div></div>

    @push('scripts')

        <script>
            $("select").select2({
                placeholder: "{{ __('models/permissions.plural') }}"
            })

        </script>
    @endpush
@endsection
