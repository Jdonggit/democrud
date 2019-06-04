@extends('layouts.master')
@section('title', '首頁')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2>404</h2>
            <h4>{{ $exception->getMessage() }}</h4>
        </div>
    </div>
@endsection