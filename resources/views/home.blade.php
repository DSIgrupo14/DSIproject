@extends('layouts.general')

@section('titulo', 'CEAA | Inicio')

@section('encabezado', 'Inicio')

@section('subencabezado', 'Perfil')

@section('breadcrumb')
<li>
  <i class="fa fa-home"></i> Inicio
</li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-md-4">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/users/' . Auth::user()->imagen) }}" alt="User profile picture">
          <h3 class="profile-username text-center">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h3>
          <p class="text-muted text-center">{{ Auth::user()->rol->nombre }}</p>
          <a href="#" data-target="#modal-imagen" data-toggle="modal" class="btn btn-primary btn-block btn-flat">
            Cambiar imagen de perfil
          </a>
          <a href="#" data-target="#modal-password" data-toggle="modal" class="btn btn-primary btn-block btn-flat">
            Cambiar contraseña
          </a>
          @include('partials.imagen-perfil')
          @include('partials.password-perfil')
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection