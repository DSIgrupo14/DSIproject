@extends('layouts.general')

@section('titulo', 'CEAA | Crear Nivel Educativo')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Crear Nivel Educativo')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-cog"></i> Configuración
</li>
<li>
  <a href="{{ route('nivel.index') }}">Nivel Educativo</a>
</li>
<li class="active">
  Registrar Nivel Educativo
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Nivel Educativo</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'nivel.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Código -->
      <div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
        {!! Form::label('Codigo', 'Código', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('codigo', old('codigo'), ['class' => 'form-control', 'placeholder' => 'Código del Nivel Educativo', 'required']) !!}
            @if ($errors->has('codigo'))
            <span class="help-block">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
      </div>
      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre del Nivel Educativo', 'required']) !!}
            @if ($errors->has('nombre'))
            <span class="help-block">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
      </div>
      <!-- Materias -->
      <div class="form-group">
        {!! Form::label('materias', 'Materias', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('materias[]', $materias, old('materias[]'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => '-- Seleccione las materias que se imparten --', 'style' => 'width: 100%']) !!}
        </div>
      </div>
      <!-- Orientador imparte todas las materias -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('orientador_materia', 1) !!} Orientador imparte todas las materias
            </label>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('nivel.index') }}" class="btn btn-default btn-flat">Cancelar</a>
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
