@extends('layouts.general')

@section('titulo', 'CEAA | Jornada Laboral')

@section('encabezado', 'Jornada Laboral')

@section('subencabezado', 'Detalle')

@section('breadcrumb')
<li>
  <i class="fa fa-clock-o"></i>
  <a href="{{ route('jornadas.index') }}">Jornada Laboral</a>
</li>
<li class="active">
  Detalle de la Jornada Laboral
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Detalle de la Jornada Laboral</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-5">
        <div class="pull-right">
          <a href="{{ url('img/docentes/' . $jornada->docente->imagen) }}" target="_blanck">
            <img src="{{ asset('img/docentes/' . $jornada->docente->imagen) }}" class="img-thumbnail img-detalle-usuario" alt="Imagen de docente">
          </a>
        </div>
      </div>
      <div class="col-sm-6">
        <h3>{{ $jornada->docente->user->nombre }} {{ $jornada->docente->user->apellido }}</h3>
        <br>
        <p>
         <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($jornada->fecha)->format('d/m/Y') }}
        </p>
        <p>
         <strong>Hora de entrada:</strong> {{ $jornada->hora_entrada }}
        </p>
        <p>
         <strong>Hora de salida:</strong> {{ $jornada->hora_salida }}
        </p>
        <p>
          <strong>Registro:</strong> {{ \Carbon\Carbon::parse($jornada->created_at)->format('d/m/Y - H:i:s') }}
        </p>
        <p>
          <strong>Última modificación:</strong> {{ \Carbon\Carbon::parse($jornada->updated_at)->format('d/m/Y - H:i:s') }}
        </p>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection