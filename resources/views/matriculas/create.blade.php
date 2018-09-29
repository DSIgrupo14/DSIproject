@extends('layouts.general')

@section('titulo', 'CEAA | Matrículas')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Matrículas')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-child"></i>
  <a href="{{ route('matriculas.index') }}">Matrículas</a>
</li>
<li class="active">
  Registrar Matrícula
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Matrícula</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'matriculas.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Alumno -->
      <div class="form-group{{ $errors->has('alumno_id') ? ' has-error' : '' }}">
        {!! Form::label('alumno_id', 'Alumno *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('alumno_id', $alumnos, old('alumno_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un alumno --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('alumno_id'))
          <span class="help-block">{{ $errors->first('alumno_id') }}</span>
          @endif
        </div>
      </div>
      <!-- Grado -->
      <div class="form-group{{ $errors->has('grado_id') ? ' has-error' : '' }}">
        {!! Form::label('grado_id', 'Grado *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('grado_id', $grados, old('grado_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un grado --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('grado_id'))
          <span class="help-block">{{ $errors->first('grado_id') }}</span>
          @endif
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('matriculas.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection