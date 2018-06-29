<!DOCTYPE html>
<html>
<head>
    <title>CEAA | Login </title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
    <hr>
        @if (session()->has('flash'))
        <div class="alert alert-info" > {{ session('flash') }} </div>
        @endif
    <div class=" panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-tittle">Incio de Sesion</h1>
        </div>

        <div class="panel-body">
            <form method="POST" action=" {{ route('login') }} ">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" 
                           type="nombre" name="nombre"
                           value=" {{ old('nombre')}} " 
                           placeholder="Ingresa tu UserName">
                </div>

                @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
                @endif

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input class="form-control" 
                           type="password" 
                           name="password" 
                           placeholder="*************">
                </div>

                @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
                @endif

                <button class="btn btn-primary btn-block"> Acceder </button>
            </form>
        </div>
    </div>
    </div>
</div>

</body>
</html>
