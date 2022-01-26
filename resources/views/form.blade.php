@extends("master")


@section("section")
<form action="{{route("publish.facebook",'278561817144387')}}" method="post"  enctype="multipart/form-data">
     @csrf
   
     <input type="text" name="name">
     <input type="text" name="message">
    <button>Submit</button>
</form>

@endsection