@extends('layouts.app')
@push("page_css")
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                      @lang('models/banners.singular')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <form action="{{route("banners.ajax")}}" class="dropzone" id="mygreatdropzone" enctype="multipart/form-data">
                <div class="fallback">
                  <input name="file" type="file" accept="image/*" multiple />
                </div>
              </form>
 

        </div>
    </div>
@endsection
@push("page_scripts")
<script>
    $(document).ready(function()
    {
    // Note that the name "myDropzone" is the camelized
    // id of the form.
    
        Dropzone.options.mygreatdropzone = { // camelized version of the `id`
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 50, // MB
         
            accept:function(file,done)
            {
                done("not allowed")
            }
        };
        // let dropzone =  Dropzone(document.querySelector("#myGreatDropzone"))
    })
    
  </script>

@endpush