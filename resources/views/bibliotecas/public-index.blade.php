<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotecas Públicas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .info { background-color: #d1ecf1; color: #0c5460; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bibliotecas Públicas</h1>
        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
    </div>

    <div class="info">
        Esta es una vista pública. <a href="{{ route('login') }}">Inicia sesión</a> para acceder a todas las funcionalidades.
    </div>

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
                        <a href="{{ route('public.bibliotecas.show', $biblioteca->id) }}" class="btn btn-success">Ver Libros</a>
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
