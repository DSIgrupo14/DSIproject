@extends('layouts.general')

@section('titulo', 'CEAA | Pago de Alimentos')

@section('encabezado', 'Pago de Alimentos')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-cutlery"></i> Pago de Alimentos
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Pago de Alimentos</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('pagos.create') }}" class="btn btn-primary btn-flat">Registrar Pago de Alimentos</a>
      </div>
      <div class="col-sm-6">
      	<!-- Barra de búsqueda -->
      	@include('pagos.search')
      </div>
    </div>
  	<!-- Listado de pagos de alimentos -->
  	@if ($pagos->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Año</th>
            <th>Mes</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pagos as $pago)
          <tr>
            <td>{{ $pago->anio->numero }}</td>
            <td>{{ $pago->mes }}</td>
            <td>
              <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $pago->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('pagos.modal')
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