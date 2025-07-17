@extends('admin.dashboard')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>{{ 'Miembros del Comité: ' . $comite->carrera }}</h3>
            <div>
                <a href="{{ route('admin.comites') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
            </div>
        </div>
        <table class="table table-bordered table-hover bg-white tabla-investigaciones">
            <thead class="table-light">
                <tr>
                    <th>ROL</th>
                    <th>INTEGRANTE</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($miembros as $miembro)
                    <tr>
                        <td class="text-center">{{ $miembro->rol }}</td>
                        <td>{{ $miembro->nombre }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $miembro->id }}"><i class="fas fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger btn-eliminar" data-id="{{ $miembro->id }}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $miembro->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('miembros.update', $miembro->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Miembro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input name="rol" class="form-control mb-3" value="{{ $miembro->rol }}"
                                            required>
                                        <input name="nombre" class="form-control mb-3" value="{{ $miembro->nombre }}"
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
        @if ($miembros->hasPages())
            <div class="paginacion">
                @if ($miembros->onFirstPage())
                    <button class="disabled" disabled>Anterior</button>
                @else
                    <a href="{{ $miembros->previousPageUrl() }}"><button>Anterior</button></a>
                @endif

                <span style="align-self:center;">
                    Página {{ $miembros->currentPage() }} de {{ $miembros->lastPage() }}
                </span>

                @if ($miembros->hasMorePages())
                    <a href="{{ $miembros->nextPageUrl() }}"><button>Siguiente</button></a>
                @else
                    <button class="disabled" disabled>Siguiente</button>
                @endif
            </div>
        @endif
    </div>
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('miembros.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="comite_id" value="{{ $comite->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Miembro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input name="rol" class="form-control mb-3" placeholder="Rol" required>
                        <input name="nombre" class="form-control mb-3" placeholder="Integrante" required>
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
                        form.action = `miembros/delete/${id}`;
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
