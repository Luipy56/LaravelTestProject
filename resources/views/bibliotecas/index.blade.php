<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotecas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; color: white; }
        .success { background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bibliotecas</h1>
        <a href="{{ route('bibliotecas.create') }}" class="btn btn-primary">Nueva Biblioteca</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bibliotecas as $biblioteca)
                <tr>
                    <td>{{ $biblioteca->id }}</td>
                    <td>{{ $biblioteca->name }}</td>
                    <td>{{ $biblioteca->address }}</td>
                    <td>
                        <a href="{{ route('libros.show', $biblioteca->id) }}" class="btn btn-success">Ver Libros</a>
                        <a href="{{ route('bibliotecas.edit', $biblioteca->id) }}" class="btn btn-warning">Editar</a>
                        <form method="POST" action="{{ route('bibliotecas.destroy', $biblioteca->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay bibliotecas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
