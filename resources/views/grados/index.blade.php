@extends('layouts.general')

@section('titulo', 'CEAA | Grados')

@section('encabezado', 'Grados')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Gestión Académica
</li>
<li class="active">
  Grados
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Grados</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('grados.create') }}" class="btn btn-primary btn-flat">Registrar Grado</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('grados.search')
      </div>
    </div>
  	<!-- Listado de grados -->
  	@if ($grados->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Nivel</th>
            <th>Año</th>
            <th>Docente</th>
            <th>Seccion</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($grados as $grado)
          <tr>
            <td>{{ $grado->codigo }}</td>
            <td>{{ $grado->nivel->nombre }}</td>
            <td>{{ $grado->anio->numero }}</td>
            <td>{{ $grado->docente->user->nombre }}
                {{ $grado->docente->user->apellido }}</td>
            <td>{{ $grado->seccion }}</td>
            <td>
              <a href="{{ route('grados.edit', $grado->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $grado->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('grados.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay grados-->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron docentes</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $grados->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection