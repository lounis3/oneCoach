<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hoja de Estadisticas</title>
</head>
<body>
<div>
    <div>
        <h1>Hoja de Estadisticas</h1>
    </div>
    <div>

        @if($estadisticas->isEmpty())
            <h3>No hay estadisticas en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>Partidos Jugados</th>
                    <th>Goles</th>
                    <th>Asistencias</th>
                    <th>Ciclo Tarjetas</th>
                    <th>Jugador</th>
                </tr>
                </thead>
                <tbody>
                @foreach($estadisticas as $estadistica)
                    <tr>
                        <td>{!! $estadistica->partidos_jug !!}</td>
                        <td>{!! $estadistica->goles !!}</td>
                        <td>{!! $estadistica->asistencias !!}</td>
                        <td>{!! $estadistica->ciclo_tarjetas !!}</td>
                        <td>{!! $estadistica->jugador !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
