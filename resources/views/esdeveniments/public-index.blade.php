<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Públicos</title>
</head>
<body>
    <h1>Eventos Públicos</h1>
    <a href="{{ route('login') }}">Iniciar Sesión</a>

    <table border='1'>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Descripción corta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($eventos as $evento)
                <tr>
                    <td>{{ $evento->nom }}</td>
                    <td>{{ $evento->data }}</td>
                    <td>{{ Str::limit($evento->descripcio, 100) }}</td>
                    <td>
                        <a href="{{ route('inscripcions.create', ['esdeveniment' => $evento->id]) }}">Inscribirse</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay eventos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
