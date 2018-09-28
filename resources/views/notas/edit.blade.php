@extends('layouts.general')

@section('titulo', 'CEAA | Notas')

@section('encabezado', 'Notas')

@section('subencabezado', 'Materia')

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i>
  <a href="{{ route('notas.index') }}">Notas</a>
</li>
<li class="active">{{ $grado->codigo }} - {{ $materia->nombre }}</li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-lg-9">
    <!-- Box Primary -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Gestión de Notas</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li>
                <strong>Año:</strong> {{ $grado->anio->numero }}
              </li>
              <li>
                <strong>Grado:</strong> {{ $grado->codigo }}
              </li>
              <li>
                <strong>Materia:</strong> {{ $materia->nombre }}
              </li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <!-- Barra de búsqueda -->
            @include('notas.search-trimestre')
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">

      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-lg-3">
    <!-- Box Primary -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Evaluaciones</h3>
      </div>
      <div class="box-body">
        <ul class="todo-list">
          @foreach ($evaluaciones as $evaluacion)
          <li>
            <span class="text">{{ $evaluacion->tipo }} ({{ $evaluacion->porcentaje * 100 }}%)</span>
            <div class="tools">
              @if ($evaluacion->posicion == count($evaluaciones) || $evaluacion->posicion != 1)
              <a href="{{ route('evaluaciones.subir', ['gra_mat' => $gra_mat, 'evaluacion' => $evaluacion->id]) }}" title="Subir"><i class="fa fa-chevron-up"></i></a>
              @endif
              @if ($evaluacion->posicion == 1 || $evaluacion->posicion != count($evaluaciones))
              <a href="{{ route('evaluaciones.bajar', ['gra_mat' => $gra_mat, 'evaluacion' => $evaluacion->id]) }}" title="Bajar"><i class="fa fa-chevron-down"></i></a>
              @endif
              <a href="{{ route('evaluaciones.edit', $evaluacion->id) }}" title="Editar"><i class="fa fa-wrench"></i></a>
              <a href="" data-target="#modal-delete-{{ $evaluacion->id }}" data-toggle="modal"><i class="fa fa-trash" title="Eliminar"></i></a>
            </div>
          </li>
          <!-- Modal para eliminar evaluación -->
          @include('evaluaciones.modal')
          @endforeach
        </ul>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="{{ route('evaluaciones.create', $gra_mat) }}" class="btn btn-primary btn-block btn-flat">
            Nueva evaluación
          </a>
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection

@section('scripts')
@endsection