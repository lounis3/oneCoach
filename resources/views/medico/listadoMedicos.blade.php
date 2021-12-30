<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Médicos</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Médicos</h1>
    </div>
    <div>

        @if($medicos->isEmpty())
            <h3>No hay medicos en la Base de Datos</h3>
        @else
            <table class="table" border="1">
                <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Puesto</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medicos as $medico)
                    <tr>
                        <td>{!! $medico->dni !!}</td>
                        <td>{!! $medico->nombre !!}</td>
                        <td>{!! $medico->apellidos !!}</td>
                        <td>{!! $medico->puesto !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
