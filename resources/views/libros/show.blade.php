<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Libro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; max-width: 800px; }
        .header { margin-bottom: 20px; }
        .detail-section { margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 4px; }
        .detail-section h2 { margin-top: 0; }
        .detail-item { margin-bottom: 10px; }
        .detail-item strong { display: inline-block; width: 120px; }
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; margin-right: 10px; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-danger { background-color: #dc3545; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Detalle del Libro</h1>
        <a href="{{ route('bibliotecas.show', $libro->biblioteca_id) }}" class="btn btn-secondary">Volver a Biblioteca</a>
    </div>

    <div class="detail-section">
        <h2>Información del Libro</h2>
        <div class="detail-item">
            <strong>ID:</strong> {{ $libro->id }}
        </div>
        <div class="detail-item">
            <strong>Título:</strong> {{ $libro->title }}
        </div>
        <div class="detail-item">
            <strong>Autor:</strong> {{ $libro->author }}
        </div>
        <div class="detail-item">
            <strong>Biblioteca:</strong> {{ $libro->biblioteca->name }}
        </div>
        @if($libro->file_path)
        <div class="detail-item">
            <strong>Archivo:</strong> 
            <a href="{{ route('libros.download', $libro->id) }}" class="btn btn-success" download>Descargar Archivo</a>
        </div>
        @else
        <div class="detail-item">
            <strong>Archivo:</strong> No hay archivo adjunto
        </div>
        @endif
    </div>

    <div class="header">
        <a href="{{ route('libros.edit', $libro->id) }}" class="btn btn-primary">Editar</a>
        <form method="POST" action="{{ route('libros.destroy', $libro->id) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
        </form>
    </div>
</body>
</html>
