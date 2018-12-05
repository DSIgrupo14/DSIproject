@extends('layouts.general')

@section('titulo', 'CEAA | Reporte Jornada Laboral')

@section('encabezado')
<button type="button" class="btn btn-primary" style="margin-right: 5px;" onclick="window.print()">
            <i class="fa fa-download"></i> Generar PDF
          </button>
@endsection

@section('contenido')
<div class="box box-primary">
  <div class="box-header with-border">
<h3 align="center">
Centro Escolar Anastasio Aquino <br>
Canton San Antonio Abajo <br>
Santiago Nonualco, La Paz<br>
Codigo 12053 <br>
</h3>
<center>
<img src="{{ asset('img/sistema/logo_ceaa.png') }}" style="width: 104px; height:139px;" >
</center>
<h4 align="center">Reporte de Docentes del Centro Escolar</h4>

<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
      <thead>
          <tr>
            <th>NIP</th>
            <th>Docente</th>
            <th>Fecha</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jornadas as $jornada)
          <tr>
            <td>{{ $jornada->nip }}</td>
            <td>{{ $jornada->nombre }} {{ $jornada->apellido }}</td>
            <td>{{ \Carbon\Carbon::parse($jornada->fecha)->format('d/m/Y') }}</td>
            <td>{{ $jornada->hora_entrada }}</td>
            <td>{{ $jornada->hora_salida }}</td>
            </tr>
            </tbody>
            </table>
 @endforeach

</div>
</div>
</div>


@endsection