<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($eventoSeleccionado)
        <title>Alta Inscripción - {{ $eventoSeleccionado->nom }} - {{ $eventoSeleccionado->data }}</title>
    @else
        <title>Alta Inscripción</title>
    @endif
</head>
<body>
    <h1>Alta Inscripción: {{ $eventoSeleccionado->nom }} - {{ $eventoSeleccionado->data }}</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('inscripcions.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label for="nom">Nombre:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <input type="hidden" name="id_esdeveniment" value="{{ $eventoSeleccionado->id }}">
        
        <div>
            <label for="fitxer">Archivoo</label>
            <input type="file" id="fitxer" name="fitxer" required>
        </div>
        
        <div>
            <button type="submit">Guardar Inscripción</button>
        </div>
    </form>
    
    <a href="{{ route('esdeveniments.index') }}">Volver a eventos</a>
</body>
</html>
