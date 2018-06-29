<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Grados</title>
  <link rel="stylesheet" type="text/css" href="css/tabla.css">
</head>
<body>

<h2 align="center">
Centro Escolar Anastasio Aquino <br>
Canton San Antonio Abajo <br>
Santiago Nonualco, La Paz<br>
Codigo 12053 <br>
</h2>
<center>
<img src=" #" style="width: 100px; height:100px;" >
</center>
<h3 align="center">Reporte de Docentes del centro escolar</h3>

<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
      <thead>
          <tr>
            <th>NIP</th>
            <th>Docente</th>
            <th>Hora de entrada</th>
            <th>Hora de salida</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jornadas as $jornada)
          <tr>
            <td>{{ $jornada->nip }}</td>
            <td>{{ $jornada->nombre }} {{ $jornada->apellido }}</td>
            <td>{{ $jornada->hora_entrada }}</td>
            <td>{{ $jornada->hora_salida }}</td>
            </tr>
 @endforeach
</tbody>
</table>
</div>


</body>
</html>