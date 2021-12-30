<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta Entrenador</title>
</head>
<body>
<div>
    <h3>Alta Entrenador</h3>
    <div>
        <!-- Validacion de errores-->
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <form action="{{ route('store') }}" method="post">
        @csrf

        <label>DNI: <input type="text" name="dni" placeholder="Introduzca su DNI" pattern="[0-9]{8}[A-Za-z]{1}"
                           title="Debe poner 8 números y una letra"></label><br />
        <label>Nombre: <input type="text" name="nombre"></label><br />
        <label>Apellidos: <input type="text" name="apellidos"></label><br />
        <label>Puesto: <input type="text" name="dorsal"></label><br />
        <label>Equipo: <input type="integer" name="equipo"></label><br />
        <input type="submit" name="submit" value="Enviar">
    </form>

    @if(session('agregar'))
        {{session('agregar')}}
    @endif
</div>
</body>
</html>
