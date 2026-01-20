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
        .info { background-color: #d1ecf1; color: #0c5460; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Libros de {{ $biblioteca->name }}</h1>
        <p><strong>Dirección:</strong> {{ $biblioteca->address }}</p>
        <a href="{{ route('public.index') }}" class="btn btn-secondary">Volver a Bibliotecas</a>
        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
    </div>

    <div class="info">
        Esta es una vista pública. <a href="{{ route('login') }}">Inicia sesión</a> para acceder a todas las funcionalidades (agregar, editar, eliminar libros).
    </div>

    <div style="margin-bottom: 20px;">
        <form method="GET" action="{{ route('public.bibliotecas.show', $biblioteca->id) }}">
            <input type="text" name="search" placeholder="Buscar por título o autor..." value="{{ $search ?? '' }}" style="padding: 8px; width: 300px;">
            <button type="submit" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Buscar</button>
            @if($search ?? false)
                <a href="{{ route('public.bibliotecas.show', $biblioteca->id) }}" class="btn btn-secondary" style="margin-left: 10px;">Limpiar</a>
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
                            <span style="color: #28a745;">Disponible</span>
                        @else
                            <span style="color: #999;">Sin archivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay libros{{ $search ?? false ? ' que coincidan con la búsqueda' : ' en esta biblioteca' }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
