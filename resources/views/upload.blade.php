<form method="post"  enctype="multipart/form-data" action="{{url('test-upload')}}">
     @csrf
    <input type="file" name="file">
    <input type="submit">
</form>