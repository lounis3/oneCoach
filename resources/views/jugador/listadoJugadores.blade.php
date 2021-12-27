<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Jugadores</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Jugadores</h1>
    </div>
    <div>

        @if($jugadors->isEmpty())
            <h3>No hay jugadores en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>Cod Ficha</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Dorsal</th>
                    <th>Posición</th>
                    <th>Pie Dominante</th>
                    <th>Altura</th>
                    <th>Peso</th>
                    <th>Estado Contractual</th>
                    <th>Salario</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jugadors as $jugador)
                    <tr>
                        <td>{!! $jugador->cod_ficha !!}</td>
                        <td>{!! $jugador->nombre !!}</td>
                        <td>{!! $jugador->apellidos !!}</td>
                        <td>{!! $jugador->edad !!}</td>
                        <td>{!! $jugador->dorsal !!}</td>
                        <td>{!! $jugador->posicion !!}</td>
                        <td>{!! $jugador->pie_dominante !!}</td>
                        <td>{!! $jugador->altura !!}</td>
                        <td>{!! $jugador->peso !!}</td>
                        <td>{!! $jugador->est_contrato !!}</td>
                        <td>{!! $jugador->salario !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
