@extends('layouts.general')

@section('titulo', 'CEAA | Alumnos')

@section('encabezado', 'Alumnos')

@section('subencabezado', 'Detalle')

@section('breadcrumb')
<li>
  <i class="fa fa-child"></i>
  <a href="{{ route('alumnos.index') }}">Alumnos</a>
</li>
<li class="active">
  Detalle del Alumno
</li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-sm-6 col-md-offset-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center">{{ $alumno->nombre }} {{ $alumno->apellido }}</h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>NIE</b> <a class="pull-right">{{ $alumno->nie }}</a>
          </li>
          <li class="list-group-item">
            <b>Género</b> <a class="pull-right">{{ $alumno->genero }}</a>
          </li>
          <li class="list-group-item">
            <b>Fecha de nacimiento</b> <a class="pull-right">{{ $alumno->fecha_nacimiento }}</a>
          </li>
          <li class="list-group-item">
            <b>Teléfono</b> <a class="pull-right">{{ $alumno->telefono }}</a>
          </li>
          <li class="list-group-item">
            <b>Departamento</b> <a class="pull-right">{{ $alumno->municipio->departamento->nombre }}</a>
          </li>
          <li class="list-group-item">
            <b>Municipio</b> <a class="pull-right">{{ $alumno->municipio->nombre }}</a>
          </li>
          <li class="list-group-item">
            <b>Dirección</b> <a class="pull-right">{{ $alumno->direccion }}</a>
          </li>
          <li class="list-group-item">
            <b>Responsable</b> <a class="pull-right">{{ $alumno->responsable }}</a>
          </li>
        </ul>
        <a href="{{ route('alumnos.record', $alumno->id) }}" class="btn btn-primary btn-block"><b>Récord de Notas</b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection