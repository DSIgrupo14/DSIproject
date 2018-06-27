@extends('layouts.general')

@section('titulo', 'CEAA | Roles de usuario')

@section('encabezado', 'Roles de usuario')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-shield"></i> Seguridad
</li>
<li class="active">
  Roles de usuario
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Roles de Usuario</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-flat">Registrar rol de usuario</a>
      </div>
      <div class="col-sm-6">
      	<!-- Barra de búsqueda -->
      	@include('roles.search')
      </div>
    </div>
  	<!-- Listado de roles de usuario -->
  	@if ($roles->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $rol)
          <tr>
            <td>{{ $rol->id }}</td>
            <td>{{ $rol->codigo }}</td>
            <td>{{ $rol->nombre }}</td>
            <td>
              <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $rol->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('roles.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay roles de usuario -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron roles de usuario</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $roles->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection