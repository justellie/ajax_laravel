@extends('users.master')
@section('title') {{$user->name}}  @endsection
    
@section('content')
<style>
    svg.w-5.h-5{
        width: 25px !important;
    }
    span.relative.z-0.inline-flex.shadow-sm.rounded-md{
        float: right !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <h1>Bienvenido usuario {{$user->name}} {{$user->lastname}}</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <p><strong>Nombre </strong> {{$user->name}}</p>
    <p><strong>Apellido </strong> {{$user->lastname}}</p>
    <p><strong>Email </strong> {{$user->email}}</p>
    <p><strong>Telefono </strong> {{$user->telefono}}</p>
    <p><strong>Documento </strong> {{$user->documento}}</p>
    <p><strong>Fecha de nacimiento </strong> {{$user->birthday}}</p>
    </div>
</div>


@endsection