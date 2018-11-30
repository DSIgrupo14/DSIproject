@extends('layouts.general')

@section('titulo', 'CEAA | Notas de Conducta')

@section('encabezado', $grado->codigo)

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i>
  <a href="{{ route('notas.index') }}">Notas</a>
</li>
<li class="active">Notas de Conducta</li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-xs-12">
  	<!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#">Notas de Conducta</a></li>
        <li><a href="#">Ranking</a></li>
        <li><a href="{{ route('notas.create-reporte', $grado->id) }}">Reporte de Notas</a></li>
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
          <div class="row search-margen">
            <div class="col-sm-12">
              <!-- Barra de búsqueda -->
              @include('conducta.search-trimestre')
            </div>
          </div>
          <!-- Listado de notas -->
          @if (count($valores) > 0)
          <!-- Formulario -->
          {!! Form::open(['route' => ['conducta.update'], 'autocomplete' => 'off', 'method' => 'PUT']) !!}
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alumno</th>
                  @foreach ($valores as $valor)
                  <th>
                    {{ $valor->valor }}
                  </th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @for ($i = 0; $i < count($matriculas); $i++)
                <tr>
                  <td>{{ $matriculas[$i]->alumno->apellido }}, {{ $matriculas[$i]->alumno->nombre }}</td>
                  @for ($j = 0; $j < count($notas[$i]); $j++)
                  <td>
                    {!! Form::select('notas_v[]', ['E' => 'E', 'MB' => 'MB', 'B' => 'B', 'R' => 'R', 'M' => 'M'], $notas[$i][$j]->nota, ['class' => 'form-control', 'placeholder' => '----', 'style' => 'width: 80px;'] ) !!}
                    {!! Form::hidden('notas_id[]', $notas[$i][$j]->id, ['required']) !!}
                  </td>
                  @endfor
                </tr>
                @endfor
              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="pull-right">
                <a href="{{ route('conducta.edit', $grado->id) }}" class="btn btn-default btn-flat">Cancelar</a>
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-flat']) !!}
              </div>
            </div>
          </div>
          {!! Form::hidden('grado', $grado->id, ['required']) !!}
          {!! Form::close() !!}
          <!-- Si no hay notas de conducta -->
          @else
            <div class="text-center">
              <i class="fa fa-search fa-5x" aria-hidden="true"></i>
              <h4>No se encontraron notas</h4>
            </div>
          @endif
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
</div>
@endsection

@section('scripts')
@endsection