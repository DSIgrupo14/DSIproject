@extends('layouts.general')

@section('titulo', 'CEAA | Reporte de Docentes')

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
<h4 align="center">Reporte de las Materias que imparte el Centro Escolar</h4>

<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Nivel</th>
            <th>Año</th>
            <th>Docente</th>
            <th>Seccion</th>
          </tr>
        </thead>
        <tbody>
          @foreach($grados as $grado)
          <tr>
            <td>{{ $grado->codigo }}</td>
            <td>{{ $grado->nivel->nombre }}</td>
            <td>{{ $grado->anio->numero }}</td>
            <td>{{ $grado->docente->user->nombre }}
                {{ $grado->docente->user->apellido }}</td>
            <td>{{ $grado->seccion }}</td>
            </tr>
 @endforeach
</tbody>
</table>
</div>
</div>
</div>

@endsection





