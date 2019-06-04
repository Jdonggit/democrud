@extends('layouts.master')
@section('title', '訊息列表')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2> {{ $post->title }}</h2>
            <a href="{{ route('posts.index')}}" class="btn btn-secondary btn-sm">返回</a>
            @can('update',$post)
            <a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm">編輯</a>
            <a href="#" class="btn btn-danger btn-sm" onclick = "document.getElementById('delete').submit()">刪除</a>
            @endcan
            <form method = "post" action = "{{ route('posts.destroy',$post->id)}}" id="delete">
                @csrf
                {{ method_field('DELETE') }}
            </form>
        </div>
        <div class="col-12">
           <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                {{ $post->content }}
                </div>
                <div class="card-footer">
                附件:
                @foreach($files as $file)
                    <a href="{{ route('posts.download', ['id' => $post->id,'filename'=>$file]) }}">{{ $file }}<br>
                @endforeach
                </div>
           </div>
        </div>
    </div>
@endsection
