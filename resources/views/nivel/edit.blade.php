@extends('layouts.general')

@section('titulo', 'CEAA | Nivel Educativo')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Nivel Educativo')

@section('subencabezado', 'Editar')

@section('breadcrumb')
<li>
  <i class="fa fa-cog"></i> Configuración
</li>
<li>
  <a href="{{ route('nivel.index') }}">Nivel Educativo</a>
</li>
<li class="active">
  Editar Nivel Educativo
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Nivel Educativo</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['nivel.update',$nivel], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Código -->
      <div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
        {!! Form::label('Codigo', 'Codigo', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('codigo', $nivel->codigo, ['class' => 'form-control', 'placeholder' => 'Codigo', 'required']) !!}
            @if ($errors->has('codigo'))
            <span class="help-block">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
      </div>
      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        {!! Form::label('nombre', 'Nombre', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nombre', $nivel->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre de nivel', 'required']) !!}
            @if ($errors->has('nombre'))
            <span class="help-block">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
      </div>
      <!-- Materias -->
      <div class="form-group">
        {!! Form::label('materias', 'Materias', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('materias[]', $materias, $mis_materias, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => '-- Seleccione las materias que se imparten --', 'style' => 'width: 100%']) !!}
        </div>
      </div>
      <!-- Orientador imparte todas las materias -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <div class="checkbox">
            <label>
              {!! Form::checkbox('orientador_materia', 1, $nivel->orientador_materia) !!} Orientador imparte todas las materias
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
