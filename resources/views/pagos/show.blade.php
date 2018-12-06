@extends('layouts.general')

@section('titulo', 'CEAA | Pago de Alimentos')

@section('encabezado', 'Pago de Alimentos')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-cutlery"></i> <a href="{{ route('pagos.index') }}"> Pago de Alimentos</a>
</li>
<li class="active">
  {{ $pago->anio->numero }} - {{ $pago->mes }}
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Pago de Alimentos: {{ $pago->anio->numero }} - {{ $pago->mes }}</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-8">
        <!-- Formulario de registro -->
        @include('pagos.create2')
      </div>
      <div class="col-sm-4">
      	<!-- Barra de búsqueda -->
      	@include('pagos.search2')
      </div>
    </div>
  	<!-- Listado de pagos de alimentos -->
  	@if ($pagos->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Alumno</th>
            <th>Pago</th>
            <th>Fecha de pago</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pagos as $p)
          <tr>
            <td>{{ $p->nombre }} {{ $p->apellido }}</td>
            <td>${{ $p->pago }}</td>
            <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</td>
            <td>
              <a href="" data-target="#modal-delete-{{ $pago->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('pagos.modal2')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay pagos de alimentos -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron pagos de alimentos</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $pagos->render() !!}
    </div>
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection