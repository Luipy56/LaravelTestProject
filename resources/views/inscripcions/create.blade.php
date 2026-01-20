<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($selectedEsdeveniment)
        <title>Alta Inscripción - {{ $selectedEsdeveniment->nom }} - {{ $selectedEsdeveniment->data }}</title>
    @else
        <title>Alta Inscripción</title>
    @endif
</head>
<body>
    @if($selectedEsdeveniment)
        <h1>Alta Inscripción: {{ $selectedEsdeveniment->nom }} - {{ $selectedEsdeveniment->data }}</h1>
    @else
        <h1>Alta Inscripción</h1>
    @endif
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
        
        @if($selectedEsdeveniment)
            <input type="hidden" name="id_esdeveniment" value="{{ $selectedEsdeveniment->id }}">
        @else
            <div>
                <label for="id_esdeveniment">Evento:</label>
                <select id="id_esdeveniment" name="id_esdeveniment" required>
                    <option value="">Selecciona un evento</option>
                    @foreach($esdeveniments as $esdeveniment)
                        <option value="{{ $esdeveniment->id }}">{{ $esdeveniment->nom }} - {{ $esdeveniment->data }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        
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
