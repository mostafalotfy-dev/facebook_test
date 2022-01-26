@extends('master')

@section("section")
<form action="{{route("create.album",$albumId)}}" enctype="application/x-www-form-urlencoded" class="dropzone">
    @csrf
    <div class="fallback">
      <input name="file" type="file" multiple />
    </div>
  </form>

@stop