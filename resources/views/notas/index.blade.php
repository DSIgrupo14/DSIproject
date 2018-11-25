@extends('layouts.general')

@section('titulo', 'CEAA | Notas')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Notas')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i> Notas
</li>
@endsection

@section('contenido')
<div class="row search-margen">
  <div class="col-sm-12">
    <!-- Barra de búsqueda -->
    @include('notas.search-anio')
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <!-- Lista de grados donde se es orientador -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Grados</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        @if (count($grados) > 0)
        <ul class="products-list product-list-in-box">
          @foreach ($grados as $grado)
          <li class="item">
            <div class="product-img">
              <i class="fa fa-graduation-cap fa-3x color-graduation-cap"></i>
            </div>
            <div class="product-info">
              <a href="{{ route('conducta.edit', $grado->id) }}" class="product-title">{{ $grado->codigo }}
              <span class="product-description">{{ $grado->nivel->nombre }} "{{ $grado->seccion }}"</span>
            </div>
          </li>
          <!-- /.item -->
          @endforeach
        </ul>
        @endif
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>

  @if (count($materias) > 0)
  <div class="col-sm-6">  
    <!-- Lista de grados -->
    @for ($i = 0; $i < count($materias); $i++)
    <div class="box box-primary collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $materias[$i][0]->grado }}</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <!-- Lista de materias -->
        <ul class="nav nav-stacked">
          @for ($j = 0; $j < count($materias[$i]); $j++)
          <li><a href="{{ route('notas.edit', $materias[$i][$j]->gra_mat) }}" class="product-title">{{ $materias[$i][$j]->nombre }}</a></li>
          @endfor
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @endfor
  </div>
  @endif
</div>
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