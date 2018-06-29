@extends('layouts.general')

@section('titulo', 'CEAA | Niveles Educativos')

@section('encabezado', 'Nivel Educativo')

@section('subencabezado', 'Detalle')

@section('breadcrumb')
<li>
  <i class="fa fa-cog"></i> Configuración
</li>
<li>
  <a href="{{ route('nivel.index') }}">Niveles Educativos</a>
</li>
<li class="active">
  Detalle del Nivel Educativo
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">{{ $nivel->nombre }}</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <h4>Detalle</h4>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-quitar-margen">
            <tr>
              <td><strong>Nombre:</strong> {{ $nivel->nombre }}</td>
            </tr>
            <tr>
              <td><strong>Código:</strong> {{ $nivel->codigo }}</td>
            </tr>
            @if ($nivel->orientador_materia == 1)
            <tr>
              <td><strong>Orientador imparte todas las materias</strong></td>
            </tr>
            @endif
            <tr>
              <td><strong>Registro:</strong> {{ \Carbon\Carbon::parse($nivel->created_at)->format('d/m/Y - H:i:s') }}</td>
            </tr>
            <tr>
              <td><strong>Última modificación:</strong> {{ \Carbon\Carbon::parse($nivel->updated_at)->format('d/m/Y - H:i:s') }}</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-sm-6">
        <h4>Materias</h4>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-quitar-margen">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody>
              @foreach($nivel->materias as $materia)
              <tr>
                <td>{{ $materia->codigo }}</td>
                <td>{{ $materia->nombre }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
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