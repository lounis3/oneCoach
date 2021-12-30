<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Arbitros</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Arbitros</h1>
    </div>
    <div>

        @if($arbitros->isEmpty())
            <h3>No hay Arbitros en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>Cod Arbitro</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Partido</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arbitros as $arbitro)
                    <tr>
                        <td>{!! $arbitro->cod_arbitro !!}</td>
                        <td>{!! $arbitro->nombre !!}</td>
                        <td>{!! $arbitro->apellidos !!}</td>
                        <td>{!! $arbitro->partido !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
