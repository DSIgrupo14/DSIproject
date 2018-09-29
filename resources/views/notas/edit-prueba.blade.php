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
        <!-- Listado de roles de usuario -->
        @if (count($evaluaciones) > 0)
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered table-quitar-margen">
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
                  <input type="text" id="nota-{{ $i }}-{{ $j }}" onblur="actualizar('nota-{{ $i }}-{{ $j }}', {{ $notas[$i][$j]->id }})" value="{{ $notas[$i][$j]->nota }}" style="width: 45px;">
                </td>
                @endfor
                <td>
                  <input type="text" id="promedio-{{ $i }}" value="{{ $promedios[$i] }}" disabled style="width: 45px;">
                </td>
                <td>
                  <input type="text" id="recuperacion-{{ $i }}" onblur="actualizar('recuperacion-{{ $i }}', {{ $recuperaciones[$i]->id }})" value="{{ $recuperaciones[$i]->nota }}" style="width: 45px;">
                </td>
                <td>NOTA FINAL</td>
                </td>
              </tr>
              @endfor
            </tbody>
          </table>
        </div>
        <!-- Si no hay evaluaciones -->
        @else
          <div class="text-center">
            <i class="fa fa-search fa-5x" aria-hidden="true"></i>
            <h4>No se encontraron evaluaciones</h4>
          </div>
        @endif
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        footer
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
<!-- Actualización de notas -->
@routes
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
  function actualizar(nota, evaluacion) {
    nota = document.getElementById(nota).value;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
    axios.put(route('notas.update', evaluacion) + '?' + 'nota=' + nota)
      .then(function (res) {
        console.log(res);
      })
      .catch(function (err) {
        console.log(err);
    });
  }
</script>
@endsection