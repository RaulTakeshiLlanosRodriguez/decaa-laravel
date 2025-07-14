@extends('layouts.app')

@section('contenido')
    <section class="contenedor-filtros">
        <h2>Investigaciones Docentes</h2>

        <form method="GET" class="filtros">

            <input type="text" name="docente" placeholder="Docente" value="{{ request('docente') }}">
            <input type="text" name="titulo" placeholder="Título" value="{{ request('titulo') }}">

            <select name="anio">
                <option value="">Todos los años</option>
                @foreach ($anios as $anio)
                    <option value="{{ $anio }}" {{ request('anio') == $anio ? 'selected' : '' }}>{{ $anio }}</option>
                @endforeach
            </select>

            <select name="carrera">
                <option value="">Todas las carreras</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera }}" {{ request('carrera') == $carrera ? 'selected' : '' }}>{{ $carrera }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn-repositorio">Buscar</button>
        </form>
    </section>

    <section class="listado-publicaciones">
        @forelse ($publicaciones as $pub)
            <div class="publicacion">
                <div class="etiqueta-carrera
                    {{ str_contains(strtolower($pub->carrera), 'educación') ? 'celeste' :
                       (str_contains(strtolower($pub->carrera), 'ingeniería') ? 'guinda' : 'verde') }}">
                    {{ $pub->carrera }}
                </div>
                <h4>{{ $pub->titulo }}</h4>
                <p><strong>Docente:</strong> {{ $pub->docente }}</p>
                <p><strong>Año:</strong> {{ $pub->anio }}</p>
                <a href="{{ $pub->enlace }}" class="btn-repositorio" target="_blank">Ver en Repositorio</a>
            </div>
        @empty
            <p style="text-align:center; font-style:italic; color:#666;">No se encontraron publicaciones.</p>
        @endforelse
    </section>

    @if ($publicaciones->hasPages())
        <div class="paginacion">
            @if ($publicaciones->onFirstPage())
                <button class="disabled" disabled>Anterior</button>
            @else
                <a href="{{ $publicaciones->previousPageUrl() }}"><button>Anterior</button></a>
            @endif

            <span style="align-self:center;">
                Página {{ $publicaciones->currentPage() }} de {{ $publicaciones->lastPage() }}
            </span>

            @if ($publicaciones->hasMorePages())
                <a href="{{ $publicaciones->nextPageUrl() }}"><button>Siguiente</button></a>
            @else
                <button class="disabled" disabled>Siguiente</button>
            @endif
        </div>
    @endif
@endsection
