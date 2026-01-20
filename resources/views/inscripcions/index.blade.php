<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripciones Realizadas</title>
</head>
<body>
    <h1>Inscripciones Realizadas</h1>
    
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
    
    <h2>Filtros</h2>
    <form method="GET" action="{{ route('inscripcions.index') }}">
        <div>
            <label for="nom_esdeveniment">Nombre Evento:</label>
            <input type="text" id="nom_esdeveniment" name="nom_esdeveniment" value="{{ $nomEsdeveniment ?? '' }}">
        </div>
        <div>
            <label for="data">Fecha:</label>
            <input type="date" id="data" name="data" value="{{ $data ?? '' }}">
        </div>
        <div>
            <button type="submit">Filtrar</button>
            <a href="{{ route('inscripcions.index') }}">Limpiar</a>
        </div>
    </form>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Archivo</th>
                <th>Evento</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscripcions as $inscripcio)
                <tr>
                    <td>{{ $inscripcio->id }}</td>
                    <td>{{ $inscripcio->nom }}</td>
                    <td>{{ $inscripcio->email }}</td>
                    <td><a href="{{ route('inscripcions.download', $inscripcio->id) }}">{{ $inscripcio->fitxer }}</a></td>
                    <td>{{ $inscripcio->esdeveniment->nom ?? 'N/A' }}</td>
                    <td>{{ $inscripcio->esdeveniment->data ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay inscripciones registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
