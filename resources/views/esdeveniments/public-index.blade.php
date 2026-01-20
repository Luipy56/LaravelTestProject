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

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

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
            @forelse($esdeveniments as $esdeveniment)
                <tr>
                    <td>{{ $esdeveniment->nom }}</td>
                    <td>{{ $esdeveniment->data }}</td>
                    <td>{{ Str::limit($esdeveniment->descripcio, 100) }}</td>
                    <td>
                        <a href="{{ route('inscripcions.create', ['esdeveniment' => $esdeveniment->id]) }}">Inscribirse</a>
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
