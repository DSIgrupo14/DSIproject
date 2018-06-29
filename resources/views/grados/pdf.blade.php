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
<h3 align="center">Reporte de grados del centro escolar</h3>

<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>N°</th>
            <th>Codigo</th>
            <th>Nivel</th>
            <th>Año</th>
            <th>Docente</th>
            <th>Seccion</th>
          </tr>
        </thead>
        <tbody>
          @foreach($grados as $grado)
          <tr>
            <td>{{ $grado->id }}</td>
            <td>{{ $grado->codigo }}</td>
            <td>{{ $grado->nivel->nombre }}</td>
            <td>{{ $grado->anio->numero }}</td>
            <td>{{ $grado->docente->user->nombre }}
                {{ $grado->docente->user->apellido }}</td>
            <td>{{ $grado->seccion }}</td>
            </tr>
 @endforeach
</tbody>
</table>
</div>


</body>
</html>





