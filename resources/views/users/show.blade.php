@extends('layouts.general')

@section('titulo', 'CEAA | Usuarios')

@section('encabezado', 'Usuario')

@section('subencabezado', 'Detalle')

@section('breadcrumb')
<li>
  <i class="fa fa-shield"></i> Seguridad
</li>
<li>
  <a href="{{ route('users.index') }}">Usuarios</a>
</li>
<li class="active">
  Detalle del Usuario
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Detalle del Usuario</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-5">
        <div class="pull-right">
          <a href="{{ url('img/users/' . $user->imagen) }}" target="_blanck">
            <img src="{{ asset('img/users/' . $user->imagen) }}" class="img-thumbnail img-detalle-usuario" alt="Imagen de usuario">
          </a>
        </div>
      </div>
      <div class="col-sm-6">
      	<h3>{{ $user->nombre }} {{ $user->apellido }}</h3>
        <br>
        <p>
         <strong>Rol de usuario:</strong> {{ $user->rol->nombre }}
        </p>
        <p>
         <strong>Correo electrónico:</strong> {{ $user->email }}
        </p>
        <p>
         <strong>DUI:</strong> {{ $user->dui }}
        </p>
        <p>
          <strong>Registro:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y - H:i:s') }}
        </p>
        <p>
          <strong>Última modificación:</strong> {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y - H:i:s') }}
        </p>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection