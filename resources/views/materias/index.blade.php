@extends('layouts.general')

@section('titulo', 'CEAA | Materias')

@section('encabezado', 'Materias')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li class="active">
  Materias
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Materias</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('materias.create') }}" class="btn btn-primary btn-flat">Registrar Materia</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('materias.search')
      </div>
    </div>
  	<!-- Listado de docentes -->
  	@if ($materias->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Nombre</th>
          </tr>
        </thead>
        <tbody>
          @foreach($materias as $materia)
          <tr>
            <td>{{ $materia->codigo }}</td>
            <td>{{ $materia->nombre }}</td>
            <td>
              <a href="{{ route('materias.edit', $materia->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $materia->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('materias.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay docentes -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron materias</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $materias->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection