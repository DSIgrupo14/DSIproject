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
<div class="row no-print">
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
              <button type="button" class="btn btn-primary btn-flat pull-right" onclick="window.print()">
                <i class="fa fa-print" style="margin-right: 3px;"></i> Imprimir
              </button>
              <a href="{{ route('notas.create-reporte', $grado->id) }}" class="btn btn-default btn-flat pull-right" style="margin-right: 5px;">Volver</a>
              <p style="margin-top: 7px; color: #00a65a;"><i class="fa fa-check-circle" style="margin-right: 3px;"></i> Reporte de notas generado exitosamente</p>
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

<!-- Reporte -->
<section class="invoice" style="margin-left: 0; margin-right: 0">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        Registro de Evaluación del Rendimiento Escolar
        <small class="pull-right">Fecha: {{ $hoy }}</small>
        <img src="{{ asset('img/sistema/logo_ceaa.png') }}" class="pull-left" style="width: 77px; height:101px; margin-right: 15px" />
        <small>{{ $grado->nivel->nombre }}, sección "{{ $grado->seccion }}"</small>
        <small>Centro Escolar Anastasio Aquino, Código 12053</small>
        <small>Cantón San Antonio Abajo, Santiago Nonualco</small>
        <small>Departamento La Paz, Distrito 08-07</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th rowspan="2" style="width: 12px">No.</th>
          <th rowspan="2">Nombre de los estudiantes</th>
          <th colspan="{{ count($materias) }}" style="text-align: center;">Asignatura</th>
          <th colspan="{{ count($valores) }}" style="text-align: center;">Educación moral y cívica</th>
        </tr>
        <tr>
          @foreach ($materias as $materia)
          <th style="width: 50px;"><span class="tabla-letra-vertical">{{ $materia->nombre }}</span></th>
          @endforeach
          @foreach ($valores as $valor)
          <th style="width: 50px;"><div class="tabla-letra-vertical">{{ $valor->valor }}</div></th>
          @endforeach
        </tr>
        </thead>
        <tbody>
        @for ($i = 0; $i < count($matriculas); $i++)
        <tr>
          <td style="text-align: right;">{{ $i + 1 }}.</td>
          <td>{{ $matriculas[$i]->alumno->apellido }}, {{ $matriculas[$i]->alumno->nombre }}</td>
          @for ($j = 0; $j < count($materias); $j++)
          <td>{{ $notas[$j][$i] }}</td>
          @endfor
          @for ($k = 0; $k < count($valores); $k++)
          <td>{{ $k }}</td>
          @endfor
        </tr>
        @endfor
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Payment Methods:</p>
      <img src="../../dist/img/credit/visa.png" alt="Visa">
      <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
      <img src="../../dist/img/credit/american-express.png" alt="American Express">
      <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
      </p>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <p class="lead">Amount Due 2/22/2014</p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td>$250.30</td>
          </tr>
          <tr>
            <th>Tax (9.3%)</th>
            <td>$10.34</td>
          </tr>
          <tr>
            <th>Shipping:</th>
            <td>$5.80</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>$265.24</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<div class="clearfix"></div>
@endsection