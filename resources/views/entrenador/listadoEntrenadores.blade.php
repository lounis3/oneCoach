<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listado de Entrenadores</title>
</head>
<body>
<div>
    <div>
        <h1>Listado de Entrenadores</h1>
    </div>
    <div>

        @if($entrenadores->isEmpty())
            <h3>No hay entrenadores en la Base de Datos</h3>
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
                @foreach($entrenadores as $entrenador)
                    <tr>
                        <td>{!! $entrenador->dni !!}</td>
                        <td>{!! $entrenador->nombre !!}</td>
                        <td>{!! $entrenador->apellidos !!}</td>
                        <td>{!! $entrenador->puesto !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
