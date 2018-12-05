@extends('layouts.general')

@section('titulo', 'CEAA | Valores')

@section('encabezado', 'Valores')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li class="active">
  Valores
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Valores</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('valores.create') }}" class="btn btn-primary btn-flat">Registrar Valor</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('valores.search')
      </div>
    </div>
    <!-- Listado de valores -->
    @if ($valores->count() > 0)
    <div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Valor</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($valores as $valor)
          @if($valor->estado!=0)
          <tr>
            <td>{{ $valor->valor }}</td>
            <td>
              <a href="{{ route('valores.edit', $valor->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $valor->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('valores.modal')
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay valores -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron Valores</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
      <!-- Paginación -->
      {!! $valores->render() !!}
    </div>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection