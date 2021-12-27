<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta Jugador</title>
</head>
<body>
<div>
    <h3>Alta Jugador</h3>
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

        <label>Cod Ficha: <input type="text" name="cod_ficha" placeholder="Introduzca el codigo de ficha del jugador"
            ></label><br />
        <label>Nombre: <input type="text" name="nombre"></label><br />
        <label>Apellidos: <input type="text" name="apellidos"></label><br />
        <label>Edad: <input type="integer" name="edad"></label><br />
        <label>Dorsal: <input type="integer" name="dorsal"></label><br />
        <label>Posición: <input type="text" name="posicion"></label><br />
        <label>Pie Dominante: <input type="text" name="pie_dominante"></label><br />
        <label>Altura: <input type="integer" name="altura"></label><br />
        <label>Peso: <input type="decimal" name="peso"></label><br />
        <label>Estado Contractual: <input type="date" name="est_contrato"></label><br />
        <label>Salario: <input type="integer" name="salario"></label><br />
        <input type="submit" name="submit" value="Enviar">
    </form>

    @if(session('agregar'))
        {{session('agregar')}}
    @endif
</div>
</body>
</html>
