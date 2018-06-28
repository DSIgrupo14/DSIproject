@extends('layouts.general')

@section('titulo', 'CEAA | Niveles Educativos')

@section('encabezado', 'Niveles Educativos')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li class="active">
  Niveles Educativos
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Niveles Educativos</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('niveles.create') }}" class="btn btn-primary btn-flat">Registrar Nivele Educativo</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('niveles.search')
      </div>
    </div>
  	<!-- Listado de docentes -->
  	@if ($niveles->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>ID</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Orientador_Materia</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($niveles as $nivel)
          <tr>
            <td>{{ $nivel->id }}</td>
            <td>{{ $nivel->codigo }}</td>
            <td>{{ $nivel->nombre }}</td>
            <td>{{ $nivel->orientador_materia }}</td>
            <td>
              <a href="{{ route('niveles.edit', $nivel->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $nivel->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('niveles.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay docentes -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron Niveles Educativos</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $niveles->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection