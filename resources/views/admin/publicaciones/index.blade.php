@extends('admin.dashboard')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Investigaciones Docentes</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
        </div>
        <table class="table table-bordered table-hover bg-white tabla-investigaciones">
            <thead class="table-light">
                <tr>
                    <th>TITULO</th>
                    <th>DOCENTE</th>
                    <th>AÑO</th>
                    <th>CARRERA</th>
                    <th>REPOSITORIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publicaciones as $pub)
                    <tr>
                        <td>{{ $pub->titulo }}</td>
                        <td>{{ $pub->docente }}</td>
                        <td>{{ $pub->anio }}</td>
                        <td>{{ $pub->carrera }}</td>
                        <td class="text-center"><a href="{{ $pub->enlace }}" target="_blank" class="btn btn-sm btn-info"><i
                                    class="fas fa-eye"></i>Ver</a></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $pub->id }}"><i class="fas fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger btn-eliminar" data-id="{{ $pub->id }}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $pub->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('publicaciones.update', $pub->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Publicación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input name="titulo" class="form-control mb-3" value="{{ $pub->titulo }}"
                                            required>
                                        <input name="docente" class="form-control mb-3" value="{{ $pub->docente }}"
                                            required>
                                        <input name="anio" type="number" class="form-control mb-3"
                                            value="{{ $pub->anio }}" required>
                                        <input name="carrera" class="form-control mb-3" value="{{ $pub->carrera }}"
                                            required>
                                        <input name="enlace" class="form-control mb-3" value="{{ $pub->enlace }}"
                                            required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
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
    </div>
    {{-- Modal Agregar --}}
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('publicaciones.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Publicación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input name="titulo" class="form-control mb-3" placeholder="Título" required>
                        <input name="docente" class="form-control mb-3" placeholder="Docente" required>
                        <input name="anio" type="number" class="form-control mb-3" placeholder="Año" required>
                        <input name="carrera" class="form-control mb-3" placeholder="Carrera" required>
                        <input name="enlace" class="form-control mb-3" placeholder="URL del repositorio" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('mensaje'))
        <script>
            Swal.fire({
                icon: '{{ session('tipo') }}',
                title: '{{ session('mensaje') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif
    <form id="form-eliminar" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    <script>
        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "La publicación será dada de baja.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('form-eliminar');
                        form.action = `publicaciones/delete/${id}`;
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
