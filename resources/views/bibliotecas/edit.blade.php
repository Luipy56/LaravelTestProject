<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Biblioteca</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; max-width: 600px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 20px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .error { color: red; margin-top: 5px; }
    </style>
</head>
<body>
    <h1>Editar Biblioteca</h1>
    
    <form method="POST" action="{{ route('bibliotecas.update', $biblioteca->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $biblioteca->name) }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $biblioteca->address) }}" required>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('bibliotecas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
