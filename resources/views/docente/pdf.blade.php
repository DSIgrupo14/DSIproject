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
<img src=" {{ asset('img/img.jpg')}} ">
</center>
<h3 align="center">Reporte de Docentes del centro escolar</h3>

<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>NIP</th>
            <th>Especialidad</th>
            <th>Imagen</th>
          </tr>
        </thead>
        <tbody>
          @foreach($docentes as $docente)
          <tr>
            <td>{{ $docente->id }}</td>
            <td>{{ $docente->user->nombre }}
                 {{$docente->user->apellido}} </td>
            <td>{{ $docente->nip }}</td>
            <td>{{ $docente->especialidad }}</td>
            <td>{{ $docente->imagen }}</td>
            </tr>
 @endforeach
</tbody>
</table>
</div>


</body>
</html>