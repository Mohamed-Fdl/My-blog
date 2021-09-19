@extends('admin.admin_base')
@section('title')
All posts
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Advanced Table
            </header>

            <table class="table table-striped table-advance table-hover">
                <tbody>
                    <tr>
                        <th> Post Name</th>
                        <th> Author Name</th>
                        <th> Comments</th>
                        <th><i class="icon_cogs"></i> Date</th>
                        <th><i class="icon_cogs"></i> Action</th>
                    </tr>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->name}}</td>
                        <td>{{$post->author}}</td>
                        <td>{{$post->comments->count()}}</td>
                        <td>{{Carbon\Carbon::parse($post->created_at)->format('M d Y')}}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary" href="{{route('newedit',['id'=>$post->id])}}"><i class="icon_plus_alt2"></i></a>
                                <a class="btn btn-danger" href="{{route('delPost',['id'=>$post->id])}}"><i class="icon_close_alt2"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection
