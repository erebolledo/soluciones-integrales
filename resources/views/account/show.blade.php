@extends('layouts.app')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @include('message')
    <h3>CUENTA</h3>
        <div class="row">
            <div class="col-25"><label>Nombre:</label></div>
            <div class="col-50">{{$user->name}}</div>
        </div>
        <div class="row">
            <div class="col-25"><label>Correo electrónico:</label></div>
            <div class="col-50">{{$user->email}}</div>
        </div>
        <div class="row">
            <div class="col-25"><label>Cedula/ID:</label></div>
            <div class="col-50">{{$user->identification}}</div>
        </div>
        <div class="row">
            <div class="col-25"><label>Teléfono celular:</label></div>
            <div class="col-50">{{$user->phone}}</div>
        </div>
        <div class="row">
            <div class="col-25"><label>Estado:</label></div>
            <div class="col-50">{{$user->state}}</div>
        </div>
        <div class="row">
            <div class="col-25"><label>Ciudad:</label></div>
            <div class="col-50">{{$user->city}}</div>
        </div>
        <div class="row">
            <div class="col-25"><label>Direccion de entrega:</label></div>
            <div class="col-50">{{$user->address}}</div>
        </div>

@endsection