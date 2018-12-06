@extends('layouts.general')

@section('titulo', 'CEAA | Recursos')

@section('encabezado', 'Recursos')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Administración
</li>
<li class="active">
  Recursos
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Recursos</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('recursos.create') }}" class="btn btn-primary btn-flat">Registrar Recurso</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('recursos.search')
      </div>
    </div>
    <!-- Listado de valores -->
    @if ($recursos->count() > 0)
    <div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recursos as $recurso)
          <tr>
            <td>{{ $recurso->nombre }}</td>
            <td>{{ $recurso->descripcion }}</td>
            <td>
              <a href="{{ route('recursos.edit', $recurso->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $recurso->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('recursos.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay valores -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron Recursos</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
      <!-- Paginación -->
      {!! $recursos->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection