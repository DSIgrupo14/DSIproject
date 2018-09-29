@extends('layouts.general')

@section('titulo', 'CEAA | Crear Valor')

@section('encabezado', 'Valores')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li>
  <a href="{{ route('valores.index') }}">Valores</a>
</li>
<li class="active">
  Registrar Valor 
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Valor</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'valores.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Valor -->
      <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
        {!! Form::label('Valor', 'Valor', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textArea('valor', old('valor'), ['class' => 'form-control', 'placeholder' => 'Valor', 'required']) !!}
            @if ($errors->has('valor'))
            <span class="help-block">{{ $errors->first('valor') }}</span>
            @endif
        </div>
      </div>

    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('valores.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection