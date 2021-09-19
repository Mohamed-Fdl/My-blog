@extends('admin.admin_base')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
        @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{session('success')}}
        </div>
        @endif
            <div class="panel-body">
                <form class="form-horizontal " method="post" action="{{route('edit',['id'=>$id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Author</label>
                        <div class="col-sm-10">
                            <input type="text" name="author" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Post name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Content</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor" name="content" rows="6" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="inputSuccess">Categories</label>
                        <div class="col-lg-10">
                            @foreach (App\Models\Category::all() as $category)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"  name="{{$category->id}}"value="{{$category->id}}" >
                                    {{$category->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image upload</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </div>
</div>
@endsection
@section('title','Add post')
@section('extra-js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea'});</script>
@endsection
