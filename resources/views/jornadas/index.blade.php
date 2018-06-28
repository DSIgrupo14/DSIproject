@extends('layouts.general')

@section('titulo', 'CEAA | Jornada Laboral')

@section('encabezado', 'Jornada Laboral')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-clock-o"></i> Jornada Laboral
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de la Jornada Laboral</h3>
  </div>
  <div class="box-body">
    <div class="row search-margen">
      <div class="col-sm-6">
        <a href="{{ route('jornadas.create') }}" class="btn btn-primary btn-flat">Registrar Jornada Laboral</a>
      </div>
      <div class="col-sm-6">
        <div class="pull-right">
          <!-- Barra de búsqueda -->
          @include('jornadas.search-date')
        </div>
      </div>
    </div>
  	<!-- Listado de usuarios -->
  	@if ($jornadas->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>NIP</th>
            <th>Docente</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jornadas as $jornada)
          <tr>
            <td>{{ $jornada->nip }}</td>
            <td>{{ $jornada->nombre }} {{ $jornada->apellido }}</td>
            <td>{{ $jornada->hora_entrada }}</td>
            <td>{{ $jornada->hora_salida }}</td>
            <td>
              <a href="{{ route('jornadas.show', $jornada->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a href="{{ route('jornadas.edit', $jornada->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $jornada->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('jornadas.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay jornadas -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron jornadas</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $jornadas->render() !!}
    </div>
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('js/jquery.inputmask.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.date.extensions.js') }}"></script>
<script type="text/javascript">
  $(function () {
    // Máscaras.
    $('[data-mask]').inputmask()
  })
</script>
@endsection