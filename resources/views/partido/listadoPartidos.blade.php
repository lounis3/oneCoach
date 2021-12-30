<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Partidos</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Partidos</h1>
    </div>
    <div>

        @if($partidos->isEmpty())
            <h3>No hay Partidos en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Jornada</th>
                    <th>Adversario</th>
                    <th>Resultado</th>
                    <th>Estadio</th>
                    <th>Equipo</th></tr>
                </thead>
                <tbody>
                @foreach($partidos as $partido)
                    <tr>
                        <td>{!! $partido->fecha !!}</td>
                        <td>{!! $partido->jornada !!}</td>
                        <td>{!! $partido->adversario !!}</td>
                        <td>{!! $partido->resultado !!}</td>
                        <td>{!! $partido->estadio !!}</td>
                        <td>{!! $partido->equipo !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
