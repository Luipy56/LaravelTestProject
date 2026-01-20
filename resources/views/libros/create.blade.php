<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Libro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; max-width: 600px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], select, input[type="file"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 20px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .error { color: red; margin-top: 5px; }
    </style>
</head>
<body>
    <h1>Crear Libro</h1>
    
    <form method="POST" action="{{ route('libros.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Autor:</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}" required>
            @error('author')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="biblioteca_id">Biblioteca:</label>
            <select id="biblioteca_id" name="biblioteca_id" required>
                <option value="">Seleccione una biblioteca</option>
                @foreach($bibliotecas as $biblioteca)
                    <option value="{{ $biblioteca->id }}" {{ old('biblioteca_id') == $biblioteca->id ? 'selected' : '' }}>
                        {{ $biblioteca->name }}
                    </option>
                @endforeach
            </select>
            @error('biblioteca_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="file">Archivo:</label>
            <input type="file" id="file" name="file" accept="*/*">
            @error('file')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('bibliotecas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
