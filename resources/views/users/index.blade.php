@extends('layouts.general')

@section('titulo', 'CEAA | Usuarios')

@section('encabezado', 'Usuarios')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-shield"></i> Seguridad
</li>
<li class="active">
  Usuarios
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Usuarios</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-flat">Registrar usuario</a>
      </div>
      <div class="col-sm-6">
      	<!-- Barra de búsqueda -->
      	@include('users.search')
      </div>
    </div>
  	<!-- Listado de usuarios -->
  	@if ($users->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->nombre }} {{ $user->apellido }}</td>
            <td>{{ $user->rol->nombre }}</td>
            <td>
              <a href="{{ route('users.show', $user->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $user->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('users.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay usuarios -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron usuarios</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $users->render() !!}
    </div>
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection