@extends('layouts.general')

@section('titulo', 'CEAA | Docentes')

@section('encabezado', 'Docentes')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li class="active">
  Docentes
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Docentes</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('docentes.create') }}" class="btn btn-primary btn-flat">Registrar Docente</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('docente.search')
      </div>
    </div>
  	<!-- Listado de docentes -->
  	@if ($docentes->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>NIP</th>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($docentes as $docente)
          @if($docente->estado!=0)
          <tr>
            <td>{{ $docente->nip }}</td>
            <td>{{ $docente->user->nombre }}
                 {{$docente->user->apellido}}                           </td>
            <td>{{ $docente->especialidad }}</td>
            <td>
              <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $docente->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('docente.modal')
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay docentes -->
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
      {!! $docentes->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection