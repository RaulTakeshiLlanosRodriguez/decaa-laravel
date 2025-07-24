@extends('admin.dashboard')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Comités de Calidad</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
        </div>
        <table class="table table-bordered table-hover bg-white tabla-investigaciones">
            <thead class="table-light">
                <tr>
                    <th>CARRERA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comites as $comite)
                    <tr>
                        <td>{{ $comite->carrera }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('miembros.index', ['comite' => $comite->id]) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-users"></i> Miembros
                            </a>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $comite->id }}"><i class="fas fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger btn-eliminar" data-id="{{ $comite->id }}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $comite->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('comites.update', $comite->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Comité</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input name="carrera" class="form-control mb-3" value="{{ $comite->carrera }}"
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
        @if ($comites->hasPages())
            <div class="paginacion">
                @if ($comites->onFirstPage())
                    <button class="disabled" disabled>Anterior</button>
                @else
                    <a href="{{ $comites->previousPageUrl() }}"><button>Anterior</button></a>
                @endif

                <span style="align-self:center;">
                    Página {{ $comites->currentPage() }} de {{ $comites->lastPage() }}
                </span>

                @if ($comites->hasMorePages())
                    <a href="{{ $comites->nextPageUrl() }}"><button>Siguiente</button></a>
                @else
                    <button class="disabled" disabled>Siguiente</button>
                @endif
            </div>
        @endif
    </div>
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('comites.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Comité</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input name="carrera" class="form-control mb-3" placeholder="Comité" required>
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
                    text: "El comité será dado de baja.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('form-eliminar');
                        form.action = `comites/delete/${id}`;
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
