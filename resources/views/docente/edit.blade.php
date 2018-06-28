@extends('layouts.general')

@section('titulo', 'CEAA | Docente')

@section('encabezado', 'Docente')

@section('subencabezado', 'Editar')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li>
  <a href="{{ route('docentes.index') }}">Docente</a>
</li>
<li class="active">
  Editar Docente
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Docente</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['docentes.update',$docente], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

       <!-- ID del Usuario -->
      <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('User_id', 'Usuario', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('user_id', $users, $docente->user_id, ['class' => 'form-control', 'readonly', 'placeholder' => '-- Seleccione un Docente --', 'required']) !!}
          @if ($errors->has('user_id'))
          <span class="help-block">{{ $errors->first('user_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Nombre -->
      <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        {!! Form::label('nip', 'Nip', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nip', $docente->nip, ['class' => 'form-control', 'placeholder' => 'Nip del Docente', 'required']) !!}
            @if ($errors->has('nip'))
            <span class="help-block">{{ $errors->first('nip') }}</span>
            @endif
        </div>
      </div>
    </div>
    <!-- Especialidad -->
      <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
        {!! Form::label('especialidad', 'Especialidad', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('especialidad', $docente->especialidad, ['class' => 'form-control', 'placeholder' => 'Especialidad del Docente', 'required']) !!}
            @if ($errors->has('especialidad'))
            <span class="help-block">{{ $errors->first('especialidad') }}</span>
            @endif
        </div>
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('docentes.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection