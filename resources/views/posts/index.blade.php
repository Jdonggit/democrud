@extends('layouts.master')
@section('title', '訊息列表')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2>最新訊息</h2>
            @can('create',App\Post::class)
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-small">新增訊息</a>
            @endcan

        </div>
        <div class="col-12">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th> 發表時間 </th>
                    <th> 標題 </th>
                    <th> 發表人 </th>
                    <th> 點閱數 </th>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->created_at}}</td>
                    <td><a href="{{ route('posts.show',$post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name}} ({{$post->user->email }})</td>
                    <td>{{$post->views}}</td>
                </tr>
            @endforeach
            </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
