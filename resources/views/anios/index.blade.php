@extends('layouts.general')

@section('titulo', 'CEAA | Años Escolares')

@section('encabezado', 'Años Escolares')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li class="active">
  Años Escolares
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Años Escolares</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('anios.create') }}" class="btn btn-primary btn-flat">Registrar Año Escolar</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('anios.search')
      </div>
    </div>
    <!-- Listado de docentes -->
    @if ($anios->count() > 0)
    <div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Año</th>
            <th>Activo</th>
            <th>Editable</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($anios as $anio)
          <tr>
            <td>{{ $anio->numero }} </td>
            <td><input type="checkbox" disabled @if ($anio->activo == 1) checked @endif></td>
            <td><input type="checkbox" disabled @if ($anio->editable == 1) checked @endif></td>
            <td>
              <a href="{{ route('anios.edit', $anio->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $anio->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('anios.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay docentes -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron Años Escolares</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
      <!-- Paginación -->
      {!! $anios->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection