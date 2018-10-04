@extends('layouts.general')

@section('titulo', 'CEAA | Notas')

@section('encabezado', 'Notas')

@section('subencabezado', $grado->codigo . ' - ' . $materia->nombre)

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
        <div class="row search-margen">
          <div class="col-sm-12">
            <!-- Barra de búsqueda -->
            @include('notas.search-trimestre')
          </div>
        </div>
        <!-- Listado de notas -->
        @if (count($evaluaciones) > 0)
        <!-- Formulario -->
        {!! Form::open(['route' => ['notas.update'], 'autocomplete' => 'off', 'method' => 'PUT']) !!}
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th>Alumno</th>
                @foreach ($evaluaciones as $evaluacion)
                <th>
                  {{ $evaluacion->tipo }}
                  <br>
                  ({{ $evaluacion->porcentaje * 100 }}%)
                </th>
                @endforeach
                <th>NOTA</th>
                <th>REC</th>
                <th>NOTA FINAL</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < count($matriculas); $i++)
              <tr>
                <td>{{ $matriculas[$i]->alumno->apellido }}, {{ $matriculas[$i]->alumno->nombre }}</td>
                @for ($j = 0; $j < count($notas[$i]); $j++)
                <td>                  
                  {!! Form::text('notas_v[]', $notas[$i][$j]->nota, ['class' => 'form-control', 'required', 'style' => 'width: 60px;']) !!}
                  {!! Form::hidden('notas_id[]', $notas[$i][$j]->id, ['required']) !!}
                </td>
                @endfor
                <td>
                  {!! Form::text('promedios[]', $promedios[$i], ['class' => 'form-control', 'disabled', 'style' => 'width: 60px;']) !!}
                </td>
                <td>
                  @if ($promedios[$i] < 5.0)
                  {!! Form::text('recuperaciones_v[]', $recuperaciones[$i]->nota, ['class' => 'form-control', 'required', 'style' => 'width: 60px;']) !!}
                  @else
                  {!! Form::text('recuperaciones_vista[]', $recuperaciones[$i]->nota, ['class' => 'form-control', 'required', 'style' => 'width: 60px;', 'disabled']) !!}
                  {!! Form::hidden('recuperaciones_v[]', $recuperaciones[$i]->nota, ['required']) !!}
                  @endif
                  {!! Form::hidden('recuperaciones_id[]', $recuperaciones[$i]->id, ['required']) !!}
                </td>
                <td>
                  {!! Form::text('finales[]', $finales[$i], ['class' => 'form-control', 'disabled', 'style' => 'width: 60px;']) !!}
                </td>
                </td>
              </tr>
              @endfor
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="pull-right">
              <a href="{{ route('notas.edit', $gra_mat) }}" class="btn btn-default btn-flat">Cancelar</a>
              {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-flat']) !!}
            </div>
          </div>
        </div>
        {!! Form::hidden('gra_mat', $gra_mat, ['required']) !!}
        {!! Form::close() !!}
        <!-- Si no hay evaluaciones -->
        @else
          <div class="text-center">
            <i class="fa fa-search fa-5x" aria-hidden="true"></i>
            <h4>No se encontraron evaluaciones</h4>
          </div>
        @endif
      </div>
      <!-- /.box-body -->
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
              @if (($evaluacion->posicion == count($evaluaciones) && count($evaluaciones) != 1) || $evaluacion->posicion != 1)
              <a href="{{ route('evaluaciones.subir', ['gra_mat' => $gra_mat, 'evaluacion' => $evaluacion->id]) }}" title="Subir"><i class="fa fa-chevron-up"></i></a>
              @endif
              @if (($evaluacion->posicion == 1 && count($evaluaciones) != 1) || $evaluacion->posicion != count($evaluaciones))
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