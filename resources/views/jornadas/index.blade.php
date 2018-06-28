@extends('layouts.general')

@section('titulo', 'CEAA | Jornada Laboral')

@section('encabezado', 'Jornada Laboral')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li class="active">
  Jornada Laboral
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Jornada Laboral</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('jornadas.create') }}" class="btn btn-primary btn-flat">Registrar Jornada Laboral</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->

      </div>
    </div>
  	<!-- Listado de jornadas -->
  	@if ($jornadas->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>ID</th>
            <th>Docente</th>
            <th>Fecha</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jornadas as $jornada)
          <tr>
            <td>{{ $jornada->id }}</td>
            <td>{{ $jornada->docente->user->nombre }} 
             {{ $jornada->docente->user->apellido }} </td>
            <td>{{ $jornada->fecha }}</td>
            <td>{{ $jornada->hora_entrada }}</td>
            <td>{{ $jornada->hora_salida }}</td>
            <td>
              <a href="{{ route('jornadas.edit', $jornada->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $jornada->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('jornadas.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay jornadas -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron jornadas</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $jornadas->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection