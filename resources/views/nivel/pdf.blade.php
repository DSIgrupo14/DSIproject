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
            <th>codigo</th>
            <th>nombre</th>
            <th>orientador_materia</th>
          </tr>
        </thead>
        <tbody>
          @foreach($niveles as $nivel)
          <tr>
            <td>{{ $nivel->codigo }}</td>
            <td>{{ $nivel->nombre }}</td>
            <td>{{ $nivel->orientador_materia }}</td>
            </tr>
 @endforeach
</tbody>
</table>
</div>


</body>
</html>