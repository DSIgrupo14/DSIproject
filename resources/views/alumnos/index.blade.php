@extends('layouts.general')

@section('titulo', 'CEAA | Alumnos')

@section('encabezado', 'Alumnos')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-child"></i> Alumnos
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Alumnos</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('alumnos.create') }}" class="btn btn-primary btn-flat">Registrar Alumno</a>
      </div>
      <div class="col-sm-6">
      	<!-- Barra de búsqueda -->
      	@include('alumnos.search')
      </div>
    </div>
  	<!-- Listado de alumnos -->
  	@if ($alumnos->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>NIE</th>
            <th>Nombre</th>
            <th>Género</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($alumnos as $alumno)
          <tr>
            <td>{{ $alumno->nie }}</td>
            <td>{{ $alumno->nombre }} {{ $alumno->apellido }}</td>
            <td>{{ $alumno->genero }}</td>
            <td>
              <a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-default btn-flat" title="Ver detalle">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-default btn-flat" title="Editar">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $alumno->id }}" data-toggle="modal" class="btn btn-danger btn-flat" title="Eliminar">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('alumnos.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay alumnos -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron alumnos</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $alumnos->render() !!}
    </div>
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection