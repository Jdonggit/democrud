@extends('layouts.master')
@section('title', '訊息列表')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2>最新訊息</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-small">新增訊息</a>
        </div>
    </div>
@endsection
