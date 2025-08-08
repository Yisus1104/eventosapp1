<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eventos - Salón de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .main-content {
            margin-top: 90px;
            margin-bottom: 60px;
        }

        .card-img-top {
            height: 240px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .event-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .event-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            padding: 1.75rem;
        }

        .page-header {
            background-color: #f3f4f6;
            padding: 3.5rem 0;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
        }

        .page-header p {
            font-size: 1.25rem;
            opacity: 0.75;
        }

        .search-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 0.5rem;
            margin-bottom: 2rem;
        }

        .search-box .form-control {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
        }

        .btn-dark {
            background-color: #222;
        }

        .btn-dark:hover {
            background-color: #000;
            transform: translateY(-2px);
        }

        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .modal-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid #f0f0f0;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
        }

        .price-tag {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 4rem 2rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 2rem 0;
        }

        .pagination {
            margin-top: 3rem;
        }

        .pagination .page-link {
            border: none;
            border-radius: 8px;
            color: #333;
            margin: 0 4px;
            padding: 0.6rem 1rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #222;
        }
        
        .alert {
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }
        
        label.form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        
        .container {
            max-width: 1200px;
            padding: 0 2rem;
        }
        
        .row {
            margin-left: -15px;
            margin-right: -15px;
        }
        
        .col, [class*="col-"] {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        /* Espacio para botones de acción */
        .actions-container {
            margin-top: 1.5rem;
        }
        
        /* Espacio entre botones */
        .btn + .btn {
            margin-left: 0.75rem;
        }
        
        /* Imagen en modal de detalles */
        .modal-image {
            border-radius: 8px;
            overflow: hidden;
        }
        
        /* Estilos para alertas informativas */
        .alert-light {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #495057;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    @include('fragments.navbar')
    
    <div class="main-content">
        <!-- Header mejorado -->
        <div class="page-header">
            <div class="container">
                <h1 class="text-center">Nuestros Eventos</h1>
                <p class="text-center mb-0">Espacios diseñados para cada ocasión especial</p>
            </div>
        </div>

        <div class="container">
            <!-- Mensajes de alerta mejorados -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="row align-items-center mb-4">
                <!-- Buscador mejorado -->
                <div class="col-md-8 mb-4 mb-md-0">
                    <form action="{{ route('eventos') }}" method="GET" class="d-flex search-box">
                        <input class="form-control me-3" type="search" placeholder="Buscar eventos..." name="busqueda" value="{{ request('busqueda') }}">
                        <button class="btn btn-dark" type="submit">Buscar</button>
                    </form>
                </div>
                
                <!-- Botón para crear evento (solo admin) -->
                @if(Auth::check() && Auth::user()->isAdmin())
                    <div class="col-md-4 text-md-end">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearEventoModal">
                            Crear Nuevo Evento
                        </button>
                    </div>
                @endif
            </div>
            
            <!-- Listado de eventos -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($eventos as $evento)
                    <div class="col">
                        <div class="card h-100 event-card">
                            <div class="position-relative">
                                @if($evento->imagen)
                                    <img src="{{ Storage::url($evento->imagen) }}" class="card-img-top" alt="{{ $evento->nombre }}">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                                        <span class="text-muted">No imagen</span>
                                    </div>
                                @endif
                                <div class="price-tag">
                                    ${{ number_format($evento->precio, 2) }}
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $evento->nombre }}</h5>
                                <p class="card-text text-muted mb-4">
                                    <i class="bi bi-people-fill me-2"></i>
                                    {{ $evento->capacidad }} personas
                                </p>
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-outline-dark me-2 flex-grow-1" data-bs-toggle="modal" data-bs-target="#detalleEventoModal{{ $evento->id }}">
                                        Detalles
                                    </button>
                                    <button class="btn btn-dark flex-grow-1" data-bs-toggle="modal" data-bs-target="#reservarEventoModal{{ $evento->id }}">
                                        Reservar
                                    </button>
                                </div>
                                
                                <!-- Opciones de edición/eliminación (solo admin) -->
                                @if(Auth::check() && Auth::user()->isAdmin())
                                    <div class="mt-3 d-flex justify-content-between">
                                        <button class="btn btn-outline-secondary flex-grow-1 me-2" data-bs-toggle="modal" data-bs-target="#editarEventoModal{{ $evento->id }}">
                                            Editar
                                        </button>
                                        <button class="btn btn-outline-danger flex-grow-1" data-bs-toggle="modal" data-bs-target="#eliminarEventoModal{{ $evento->id }}">
                                            Eliminar
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal de detalles del evento -->
                    <div class="modal fade" id="detalleEventoModal{{ $evento->id }}" tabindex="-1" aria-labelledby="detalleEventoModalLabel{{ $evento->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-4" id="detalleEventoModalLabel{{ $evento->id }}">
                                        {{ $evento->nombre }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-4 mb-md-0">
                                            @if($evento->imagen)
                                                <div class="modal-image">
                                                    <img src="{{ Storage::url($evento->imagen) }}" class="img-fluid rounded" alt="{{ $evento->nombre }}">
                                                </div>
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                                                    <span class="text-muted">No imagen disponible</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="mb-4 fs-4">Detalles del evento</h4>
                                            <div class="mb-3">
                                                <p class="mb-3">
                                                    <strong class="d-block mb-1">Precio:</strong>
                                                    <span class="fs-5">${{ number_format($evento->precio, 2) }}</span>
                                                </p>
                                                <p class="mb-3">
                                                    <strong class="d-block mb-1">Capacidad:</strong>
                                                    <span class="fs-5">{{ $evento->capacidad }} personas</span>
                                                </p>
                                            </div>
                                            <hr class="my-4">
                                            <h5 class="mb-3 fs-5">Descripción</h5>
                                            <p class="text-muted">{{ $evento->descripcion }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#reservarEventoModal{{ $evento->id }}" data-bs-dismiss="modal">
                                        Reservar ahora
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal para reservar evento -->
                    <div class="modal fade" id="reservarEventoModal{{ $evento->id }}" tabindex="-1" aria-labelledby="reservarEventoModalLabel{{ $evento->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-4" id="reservarEventoModalLabel{{ $evento->id }}">
                                        Reservar: {{ $evento->nombre }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('reservaciones.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="evento_id" value="{{ $evento->id }}">
                                        
                                        <div class="mb-4">
                                            <label for="fecha_reserva" class="form-label">
                                                Fecha de reservación
                                            </label>
                                            <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" required min="{{ date('Y-m-d') }}">
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3 mb-md-0">
                                                <label for="hora_inicio" class="form-label">
                                                    Hora de inicio
                                                </label>
                                                <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="hora_fin" class="form-label">
                                                    Hora de finalización
                                                </label>
                                                <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="notas" class="form-label">
                                                Notas adicionales
                                            </label>
                                            <textarea class="form-control" id="notas" name="notas" rows="4" placeholder="Detalles adicionales para su reservación..."></textarea>
                                        </div>
                                        
                                        <div class="alert alert-light border mt-4">
                                            <small>
                                                Al realizar esta reserva, está solicitando el evento para la fecha y horario especificados. Recibirá una confirmación cuando su reserva sea aprobada.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-dark">
                                            Confirmar reservación
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal para editar evento (solo admin) -->
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="modal fade" id="editarEventoModal{{ $evento->id }}" tabindex="-1" aria-labelledby="editarEventoModalLabel{{ $evento->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-4" id="editarEventoModalLabel{{ $evento->id }}">
                                            Editar Evento
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-4">
                                                <label for="nombre" class="form-label">
                                                    Nombre del evento
                                                </label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $evento->nombre }}" required>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="descripcion" class="form-label">
                                                    Descripción
                                                </label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ $evento->descripcion }}</textarea>
                                            </div>
                                            
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <label for="precio" class="form-label">
                                                        Precio
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" value="{{ $evento->precio }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="capacidad" class="form-label">
                                                        Capacidad
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" value="{{ $evento->capacidad }}" required>
                                                        <span class="input-group-text">personas</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="imagen" class="form-label">
                                                    Imagen
                                                </label>
                                                @if($evento->imagen)
                                                    <div class="mb-4">
                                                        <img src="{{ Storage::url($evento->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="height: 120px;">
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                                <small class="text-muted d-block mt-2">Dejar en blanco para mantener la imagen actual</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-dark">
                                                Guardar cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal para eliminar evento -->
                        <div class="modal fade" id="eliminarEventoModal{{ $evento->id }}" tabindex="-1" aria-labelledby="eliminarEventoModalLabel{{ $evento->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-4" id="eliminarEventoModalLabel{{ $evento->id }}">
                                            Confirmar eliminación
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-5 mb-4">¿Está seguro que desea eliminar el evento <strong>{{ $evento->nombre }}</strong>?</p>
                                        <div class="alert alert-light border mt-4">
                                            <small>
                                                <strong>Atención:</strong> Esta acción no se puede deshacer y eliminará también todas las reservaciones asociadas.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Eliminar definitivamente
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <h4 class="mt-3 fs-3 mb-4">No hay eventos disponibles</h4>
                            <p class="text-muted fs-5 mb-4">
                                @if(request('busqueda'))
                                    No se encontraron eventos que coincidan con "{{ request('busqueda') }}".
                                @else
                                    No hay eventos disponibles en este momento.
                                @endif
                            </p>
                            
                            @if(Auth::check() && Auth::user()->isAdmin())
                                <button class="btn btn-dark mt-4" data-bs-toggle="modal" data-bs-target="#crearEventoModal">
                                    Crear primer evento
                                </button>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Paginación -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $eventos->links() }}
            </div>
        </div>
    </div>
    
    <!-- Modal para crear evento (solo admin) -->
    @if(Auth::check() && Auth::user()->isAdmin())
        <div class="modal fade" id="crearEventoModal" tabindex="-1" aria-labelledby="crearEventoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-4" id="crearEventoModalLabel">
                            Crear Nuevo Evento
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="nombre" class="form-label">
                                    Nombre del evento
                                </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="descripcion" class="form-label">
                                    Descripción
                                </label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="precio" class="form-label">
                                        Precio
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="capacidad" class="form-label">
                                        Capacidad
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" required>
                                        <span class="input-group-text">personas</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="imagen" class="form-label">
                                    Imagen
                                </label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-dark">
                                Crear evento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    
    @include('fragments.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    
    <script>
        // Validación para asegurar que la hora de fin sea posterior a la hora de inicio
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                const horaInicio = form.querySelector('[name="hora_inicio"]');
                const horaFin = form.querySelector('[name="hora_fin"]');
                
                if (horaInicio && horaFin) {
                    form.addEventListener('submit', function(event) {
                        if (horaInicio.value >= horaFin.value) {
                            event.preventDefault();
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-5';
                            alertDiv.style.zIndex = '9999';
                            alertDiv.innerHTML = `
                                La hora de finalización debe ser posterior a la hora de inicio.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            `;
                            document.body.appendChild(alertDiv);
                            
                            setTimeout(() => {
                                alertDiv.remove();
                            }, 5000);
                        }
                    });
                }
            });
        });

        // Previsualización de imagen al seleccionar
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                const preview = document.querySelector(`#preview-${this.id}`);
                if (!preview) {
                    const container = document.createElement('div');
                    container.id = `preview-${this.id}`;
                    container.className = 'mb-4 mt-3';
                    this.parentNode.insertBefore(container, this.nextSibling);
                }
                
                const previewContainer = document.querySelector(`#preview-${this.id}`);
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.innerHTML = `
                            <img src="${e.target.result}" class="img-thumbnail mt-3" style="max-height: 180px; border-radius: 8px;">
                        `;
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    previewContainer.innerHTML = '';
                }
            });
        });

// Cerrar alertas automáticamente después de 5 segundos
document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-light)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeButton = alert.querySelector('.btn-close');
                    if (closeButton) {
                        closeButton.click();
                    }
                }, 5000);
            });
        });

        // Añadir animación suave al scroll hacia secciones
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId !== '#') {
                    document.querySelector(targetId).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Mejorar la interacción al pasar el cursor sobre las tarjetas
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const img = this.querySelector('.card-img-top');
                if (img) {
                    img.style.transform = 'scale(1.05)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                const img = this.querySelector('.card-img-top');
                if (img) {
                    img.style.transform = 'scale(1)';
                }
            });
        });
    </script>
</body>
</html>