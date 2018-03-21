@extends('layouts.app')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @include('account.form')
@endsection