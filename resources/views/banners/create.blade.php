@extends('layouts.app')
@push("page_css")

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

            <form   id="my-dropzone" enctype="multipart/form-data">
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
       dropzone =  new Dropzone(document.querySelector("#my-dropzone"),{
            url:"{{route('banners.ajax')}}",
            acceptedFiles:"image/*"

        });
        $("#my-dropzone").addClass("dropzone")
    })

       
    
    
  </script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpush