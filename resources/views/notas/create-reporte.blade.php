@extends('layouts.general')

@section('titulo', 'CEAA | Reporte de Notas')

@section('encabezado', $grado->codigo)

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i>
  <a href="{{ route('notas.index') }}">Notas</a>
</li>
<li class="active">Reporte de Notas</li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-xs-12">
  	<!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="{{ route('conducta.edit', $grado->id) }}">Notas de Conducta</a></li>
        <li><a href="#">Ranking</a></li>
        <li class="active"><a href="#">Reporte de Notas</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active">
          <div class="row">
            <div class="col-sm-12">
              <ol class="breadcrumb">
                <li>
                  <strong>Año:</strong> {{ $grado->anio->numero }}
                </li>
                <li>
                  <strong>Grado:</strong> {{ $grado->codigo }}
                </li>
              </ol>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              <!-- Formulario -->
              {!! Form::open(['route' => 'notas.reporte', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                <!-- Grado -->
                <div class="form-group">
                  {!! Form::label('grado_id', 'Grado *', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-6">
                    {!! Form::text('grado', $grado->codigo, ['class' => 'form-control', 'disabled']) !!}
                    {!! Form::hidden('grado_id', $grado->id, ['required']) !!}
                  </div>
                </div>
                <!-- Tipo de reporte -->
                <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                  {!! Form::label('tipo', 'Tipo de reporte *', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-6">
                    {!! Form::select('tipo', ['A' => 'Anual', 'T' => 'Trimestral'], old('tipo'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un tipo de reporte --', 'onchange' => 'desbloquear(this.value);', 'required'] ) !!}
                    <span class="help-block" style="margin-bottom: 0;"><small>El reporte anual incluye cuadro de estadísticas del año, con el número de matrículas, retirados y promovidos.</small></span>
                    @if ($errors->has('tipo'))
                    <span class="help-block">{{ $errors->first('tipo') }}</span>
                    @endif
                  </div>
                </div>
                <!-- Trimestre -->
                <div class="form-group{{ $errors->has('trimestre') ? ' has-error' : '' }}">
                  {!! Form::label('trimestre', 'Trimestre *', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-6">
                    {!! Form::select('trimestre', ['1' => '1', '2' => '2', '3' => '3'], old('trimestre'), ['class' => 'form-control', 'placeholder' => '-- Seleccione un trimestre --', 'disabled'] ) !!}
                    @if ($errors->has('trimestre'))
                    <span class="help-block">{{ $errors->first('trimestre') }}</span>
                    @endif
                  </div>
                </div>
                <!-- Conducta -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                    <div class="checkbox">
                      <label>
                        {!! Form::checkbox('conducta', 1) !!} Incluir notas de conducta.
                        <span class="help-block" style="margin-bottom: 0;"><small>Permite que en el reporte aparezcan las columnas de educación moral y cívica.</small></span>
                      </label>
                    </div>
                  </div>
                </div>
                <!-- Desertados -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                    <div class="checkbox">
                      <label>
                        {!! Form::checkbox('desercion', 1) !!} Incluir notas de alumnos que se retiraron.
                        <span class="help-block"><small>Permite que en el reporte aparezcan las notas de los alumnos que desertaron.</small></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9">
                    <div class="pull-right">
                      {!! Form::submit('Generar reporte', ['class' => 'btn btn-primary btn-flat']) !!}
                    </div>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
// Funcion que se ejecuta al seleccionar una opcion del select de departamentos.
function desbloquear(valor)
{
  if(valor == 'T')
  {
      // Habilitamos el select de trimestre.
      document.getElementById("trimestre").disabled = false;
      document.getElementById("trimestre").required = true;
  } else {
      // Desactivamos el select de trimestre.
      document.getElementById("trimestre").disabled = true;
  }
}
</script>
@endsection