@extends('master')




@section('section')
    <form action="{{route('group.video.create',['groupId'=>$groupId])}}" enctype="multipart/form-data" method="post">
    @csrf
    <input type="text" name="title">
    <input type="text" name="description">
        <input type="file" name="file">
        <button>Submit</button>
    </form>
@endsection