@extends('layouts.general')

@section('titulo', 'CEAA | Nivel Educativo')

@section('encabezado', 'Nivel Educativo ')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-cog"></i> Configuración
</li>
<li class="active">
  Nivel Educativo
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Nivel Educativo</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('nivel.create') }}" class="btn btn-primary btn-flat">Registrar Nivel Educativo</a>
      </div>
     <div class="col-sm-6">
        <!-- Barra de búsqueda -->
        @include('nivel.search')
      </div>
    </div>
    <!-- Listado de niveles educativos -->
    @if ($nivel->count() > 0)
    <div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>codigo</th>
            <th>nombre</th>
            <th>orientador_materia</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nivel as $niveles)
          <tr>
            <td>{{ $niveles->codigo }}</td>
            <td>{{ $niveles->nombre }}</td>
            <td>{{ $niveles->orientador_materia }}</td>
            <td>
              <a href="{{ route('nivel.show', $niveles->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a href="{{ route('nivel.edit', $niveles->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $niveles->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('nivel.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay docentes -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron Nivel Educativo</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
      <!-- Paginación -->
     {!! $nivel->render() !!}
    </div>
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection