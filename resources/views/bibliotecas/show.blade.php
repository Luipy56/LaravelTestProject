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
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; margin-right: 5px; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Libros de {{ $biblioteca->name }}</h1>
        <p><strong>Dirección:</strong> {{ $biblioteca->address }}</p>
        <a href="{{ route('libros.create', ['biblioteca_id' => $biblioteca->id]) }}" class="btn btn-primary">Agregar Libro</a>
        <a href="{{ route('bibliotecas.index') }}" class="btn btn-secondary">Volver a Bibliotecas</a>
    </div>

    <div style="margin-bottom: 20px;">
        <form method="GET" action="{{ route('bibliotecas.show', $biblioteca->id) }}">
            <input type="text" name="search" placeholder="Buscar por título o autor..." value="{{ $search ?? '' }}" style="padding: 8px; width: 300px;">
            <button type="submit" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Buscar</button>
            @if($search ?? false)
                <a href="{{ route('bibliotecas.show', $biblioteca->id) }}" class="btn btn-secondary" style="margin-left: 10px;">Limpiar</a>
            @endif
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Archivo</th>
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
                        @if($libro->file_path)
                            <a href="{{ route('libros.download', $libro->id) }}" class="btn btn-success" style="padding: 4px 8px; font-size: 12px;">Descargar</a>
                        @else
                            <span style="color: #999;">Sin archivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('libros.show', $libro->id) }}" class="btn btn-success" style="padding: 4px 8px; font-size: 12px;">Ver Detalles</a>
                        <a href="{{ route('libros.edit', $libro->id) }}" class="btn btn-warning" style="padding: 4px 8px; font-size: 12px;">Editar</a>
                        <form method="POST" action="{{ route('libros.destroy', $libro->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 12px;" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay libros{{ $search ?? false ? ' que coincidan con la búsqueda' : ' en esta biblioteca' }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
