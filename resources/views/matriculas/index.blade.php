@extends('layouts.general')

@section('titulo', 'CEAA | Matrículas')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Matrículas')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-clipboard"></i> Matrículas
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Matrículas</h3>
  </div>
  <div class="box-body">
    <div class="row search-margen">
      <div class="col-sm-6">
        <a href="{{ route('matriculas.create') }}" class="btn btn-primary btn-flat">Registrar Matrícula</a>
      </div>
      <div class="col-sm-6">
        <div class="pull-right">
        	<!-- Barra de búsqueda -->
        	@include('matriculas.search')
        </div>
      </div>
    </div>
  	<!-- Listado de matrículas -->
  	@if ($matriculas->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>NIE</th>
            <th>Alumno</th>
            <th>Grado</th>
            <th>Fecha de matriculación</th>
            <th>Fecha de deserción</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($matriculas as $matricula)
          <tr>
            <td>{{ $matricula->nie }}</td>
            <td>{{ $matricula->nombre }} {{ $matricula->apellido }}</td>
            <td>{{ $matricula->codigo }}</td>
            <td>{{ \Carbon\Carbon::parse($matricula->created_at)->format('d/m/Y') }}</td>
            @if ($matricula->desercion == null)
              <td></td>
            @else
              <td>{{ \Carbon\Carbon::parse($matricula->desercion)->format('d/m/Y') }}</td>
            @endif
            <td>
              @if ($matricula->editable == 1)
              <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-default btn-flat" title="Editar">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $matricula->id }}" data-toggle="modal" class="btn btn-danger btn-flat" title="Eliminar">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
              @endif
            </td>
          </tr>
          <!-- Modal para eliminar matrícula -->
          @include('matriculas.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay matrículas -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron matrículas</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $matriculas->render() !!}
    </div>
  </div>
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