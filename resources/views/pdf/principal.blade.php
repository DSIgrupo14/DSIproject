@extends('layouts.general')

@section('titulo', 'CEAA | Reportes')

@section('encabezado', 'Reportes')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Administración
</li>
<li>
  <a href="{{ route('reportes') }}">Reportes</a>
</li>
<li class="active">
  Descargar Reportes
</li>
@endsection

@section('contenido')

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Reportes</h3>
  </div>
 
 <form class="form-horizontal">
 <div class="container" id="reporte">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Reporte de Grados</h2>
          <p>Aca encuentras toda la lista de los grados del centro escolar</p>
          <p><a class="btn btn-primary btn-flat" href="{{ route('grados.pdf') }}" role="button">Ver &raquo;</a></p>
        </div>
       
        <div class="col-md-4">
          <h2>Reporte de Docentes</h2>
          <p>Aca encontraras la lista de todos los docentes del Centro Escolar</p>
          <p><a class="btn btn-primary btn-flat" href="{{ route('docentes.pdf') }}" role="button">Ver &raquo;</a></p>
        </div>

         <div class="col-md-4">
          <h2>Reporte de Jornada Laboral</h2>
          <p>Aca encuentras la jornada laboral de cada uno de los docentes del centro  escolar  </p>
          <p><a class="btn btn-primary btn-flat" href="{{ route('jornadas.pdf') }}" role="button">Ver&raquo;</a></p>
       </div>
       
        <div class="col-md-4">
          <h2>Reporte de Materias</h2>
          <p>Aca encontraras la lista de todos las materias que imparte del Centro Escolar</p>
          <p><a class="btn btn-primary btn-flat" href="{{ route('materias.pdf') }}" role="button">Ver &raquo;</a></p>
        </div>

      </div>
    </div> <!-- /container -->    
</div>
</form>

@endsection