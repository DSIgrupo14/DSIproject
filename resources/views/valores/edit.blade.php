@extends('layouts.general')

@section('titulo', 'CEAA | Editar Valor')

@section('encabezado', 'Editar Valor')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Configuración
</li>
<li>
  <a href="{{ route('valores.index') }}">Valor</a>
</li>
<li class="active">
  Editar Valor
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Valor</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['valores.update', $valor], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Valor -->
      <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
        {!! Form::label('Valor', 'valor', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textArea('valor', $valor->valor, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
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