<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Consultas</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Consultas</h1>
    </div>
    <div>

        @if($consultas->isEmpty())
            <h3>No hay consultas en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Jugador</th>
                    <th>Medico</th>
                </tr>
                </thead>
                <tbody>
                @foreach($consultas as $consulta)
                    <tr>
                        <td>{!! $consulta->fecha !!}</td>
                        <td>{!! $consulta->jugador !!}</td>
                        <td>{!! $consulta->medico !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
