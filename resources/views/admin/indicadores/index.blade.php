@extends('admin.dashboard')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Indicadores</h3>
            <div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
            </div>
        </div>
        <table class="table table-bordered table-hover bg-white tabla-investigaciones">
            <thead class="table-light">
                <tr>
                    <th>DESCRIPCION</th>
                    <th>CANTIDAD</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($indicadores as $indicador)
                    <tr>
                        <td>{{ $indicador->descripcion }}</td>
                        <td class="text-center">{{ $indicador->cantidad }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $indicador->id }}"><i class="fas fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger btn-eliminar" data-id="{{ $indicador->id }}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    {{-- Modal Editar --}}
                    <div class="modal fade" id="modalEditar{{ $indicador->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('indicadores.update', $indicador->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Indicador</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input name="descripcion" class="form-control mb-3"
                                            value="{{ $indicador->descripcion }}" required>
                                        <input name="cantidad" type="number" min="0" class="form-control mb-3"
                                            value="{{ $indicador->cantidad }}" required>
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
        @if ($indicadores->hasPages())
            <div class="paginacion">
                @if ($indicadores->onFirstPage())
                    <button class="disabled" disabled>Anterior</button>
                @else
                    <a href="{{ $indicadores->previousPageUrl() }}"><button>Anterior</button></a>
                @endif

                <span style="align-self:center;">
                    Página {{ $indicadores->currentPage() }} de {{ $indicadores->lastPage() }}
                </span>

                @if ($indicadores->hasMorePages())
                    <a href="{{ $indicadores->nextPageUrl() }}"><button>Siguiente</button></a>
                @else
                    <button class="disabled" disabled>Siguiente</button>
                @endif
            </div>
        @endif
    </div>
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('indicadores.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Indicador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input name="descripcion" class="form-control mb-3" placeholder="Descripcion" required>
                        <input name="cantidad" type="number" min="0" class="form-control mb-3"
                            placeholder="Cantidad" required>
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
                    text: "El indicador será dado de baja.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('form-eliminar');
                        form.action = `indicadores/delete/${id}`;
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
