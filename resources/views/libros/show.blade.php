<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros de {{ $biblioteca->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Libros de {{ $biblioteca->name }}</h1>
        <p><strong>Dirección:</strong> {{ $biblioteca->address }}</p>
        <a href="{{ route('libros.create') }}" class="btn btn-primary">Agregar Libro</a>
        <a href="{{ route('bibliotecas.index') }}" class="btn btn-secondary">Volver a Bibliotecas</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($biblioteca->libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->title }}</td>
                    <td>{{ $libro->author }}</td>
                    <td>
                        <a href="{{ route('libros.edit', $libro->id) }}" class="btn btn-primary">Editar</a>
                        <form method="POST" action="{{ route('libros.destroy', $libro->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay libros en esta biblioteca</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
