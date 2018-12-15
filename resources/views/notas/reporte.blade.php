@extends('layouts.general')

@section('titulo', 'CEAA | Reporte de Notas')

@section('encabezado', $grado->codigo)

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i>
  <a href="{{ route('notas.index') }}">Notas</a>
</li>
<li class="active">Reporte de Notas</li>
@endsection

@section('contenido')
<div class="row no-print">
  <div class="col-xs-12">
  	<!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="{{ route('conducta.edit', $grado->id) }}">Notas de Conducta</a></li>
        <li><a href="#">Ranking</a></li>
        <li class="active"><a href="#">Reporte de Notas</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active">
          <div class="row">
            <div class="col-sm-12">
              <ol class="breadcrumb">
                <li>
                  <strong>Año:</strong> {{ $grado->anio->numero }}
                </li>
                <li>
                  <strong>Grado:</strong> {{ $grado->codigo }}
                </li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <button type="button" class="btn btn-primary btn-flat pull-right" onclick="window.print()">
                <i class="fa fa-print" style="margin-right: 3px;"></i> Imprimir
              </button>
              <a href="{{ route('notas.create-reporte', $grado->id) }}" class="btn btn-default btn-flat pull-right" style="margin-right: 5px;">Volver</a>
              <p style="margin-top: 7px; color: #00a65a;"><i class="fa fa-check-circle" style="margin-right: 3px;"></i> Reporte de notas generado exitosamente</p>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
</div>

<!-- Reporte -->
<section class="invoice" style="margin-left: 0; margin-right: 0">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        Registro de Evaluación del Rendimiento Escolar
        <small class="pull-right">Fecha: {{ $hoy }}</small>
        <img src="{{ asset('img/sistema/logo_ceaa.png') }}" class="pull-left" style="width: 77px; height:101px; margin-right: 15px" />
        <small>{{ $grado->nivel->nombre }}, sección "{{ $grado->seccion }}"</small>
        <small>Centro Escolar Anastasio Aquino, Código 12053</small>
        <small>Cantón San Antonio Abajo, Santiago Nonualco</small>
        <small>Departamento La Paz, Distrito 08-07</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th rowspan="2" style="width: 12px">No.</th>
          <th rowspan="2">Nombre de los estudiantes</th>
          <th colspan="{{ count($materias) }}" style="text-align: center;">Asignatura</th>
          @if ($mostrar_conducta == 1)
          <th colspan="{{ count($valores) }}" style="text-align: center;">Educación moral y cívica</th>
          @endif
        </tr>
        <tr>
          @foreach ($materias as $materia)
          <th style="width: 50px;"><span class="tabla-letra-vertical">{{ $materia->nombre }}</span></th>
          @endforeach
          @if ($mostrar_conducta == 1)
          @foreach ($valores as $valor)
          <th style="width: 50px;"><div class="tabla-letra-vertical">{{ $valor->valor }}</div></th>
          @endforeach
          @endif
        </tr>
        </thead>
        <tbody>
        @for ($i = 0; $i < count($matriculas_reales); $i++)
        <tr>
          <td style="text-align: right;">{{ $i + 1 }}.</td>
          <td>{{ $matriculas_reales[$i]->alumno->apellido }}, {{ $matriculas_reales[$i]->alumno->nombre }}</td>
          @for ($j = 0; $j < count($materias); $j++)
          <td>{{ $notas[$j][$i] }}</td>
          @endfor
          @if ($mostrar_conducta == 1)
          @for ($k = 0; $k < count($valores); $k++)
          <td>{{ $notas_conducta[$k][$i] }}</td>
          @endfor
          @endif
        </tr>
        @endfor
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th>Promedio</th>
            @foreach ($promedios as $promedio)
            <th>{{ $promedio }}</th>
            @endforeach
            @if ($mostrar_conducta == 1)
            @foreach ($valores as $valor)
            <th></th>
            @endforeach
            @endif
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  @if ($tipo == 'A')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="6" style="text-align: center;">Estadísticas</th>
          </tr>
          <tr>
            <th>Género</th>
            <th>Matrícula inicial</th>
            <th>Retirados</th>
            <th>Matrícula final</th>
            <th>Promovidos</th>
            <th>Retenidos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Femenino</th>
            <td>{{ $estadisticas['matricula_inicial_femenina'] }}</td>
            <td>{{ $estadisticas['retiradas'] }}</td>
            <td>{{ $estadisticas['matricula_final_femenina'] }}</td>
            <td>{{ $estadisticas['promovidas'] }}</td>
            <td>{{ $estadisticas['retenidas'] }}</td>
          </tr>
          <tr>
            <th>Masculino</th>
            <td>{{ $estadisticas['matricula_inicial_masculina'] }}</td>
            <td>{{ $estadisticas['retirados'] }}</td>
            <td>{{ $estadisticas['matricula_final_masculina'] }}</td>
            <td>{{ $estadisticas['promovidos'] }}</td>
            <td>{{ $estadisticas['retenidos'] }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th>Total</th>
            <td>{{ $estadisticas['matricula_inicial_femenina'] + $estadisticas['matricula_inicial_masculina'] }}</td>
            <td>{{ $estadisticas['retiradas'] + $estadisticas['retirados'] }}</td>
            <td>{{ $estadisticas['matricula_final_femenina'] + $estadisticas['matricula_final_masculina'] }}</td>
            <td>{{ $estadisticas['promovidas'] + $estadisticas['promovidos'] }}</td>
            <td>{{ $estadisticas['retenidas'] + $estadisticas['retenidos'] }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  @endif
</section>
<!-- /.content -->
<div class="clearfix"></div>
@endsection