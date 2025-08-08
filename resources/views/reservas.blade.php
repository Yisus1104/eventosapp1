<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Reservas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #fafafa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        .main-content {
            margin-top: 80px;
        }
        .reservation-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            background-color: #fff;
        }
        .status-badge {
            padding: 0.35em 0.65em;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85em;
        }
        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-confirmada {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .status-cancelada {
            background-color: #f8d7da;
            color: #842029;
        }
        .status-completada {
            background-color: #e2e3e5;
            color: #41464b;
        }
    </style>
</head>
<body>
    @include('fragments.navbar')

    <div class="main-content">
        <div class="container">
            <!-- Mensajes de alerta -->
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

            <!-- Contenido diferenciado según el rol -->
            @if(Auth::user()->isAdmin())
                <!-- Vista de administrador -->
                <div class="mb-4">
                    <h1 class="h2">Panel de Administración de Reservas</h1>
                    <p class="text-muted">Gestiona todas las reservas del sistema</p>
                </div>

                <!-- Filtros para administrador -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('reservaciones') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                    <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Desde</label>
                                <input type="date" class="form-control" name="fecha_desde" value="{{ request('fecha_desde') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Hasta</label>
                                <input type="date" class="form-control" name="fecha_hasta" value="{{ request('fecha_hasta') }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-dark w-100">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabla de reservas para administrador -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                        <th>Fecha</th>
                                        <th>Horario</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reservaciones as $reservacion)
                                        <tr>
                                            <td>{{ $reservacion->id }}</td>
                                            <td>{{ $reservacion->user->name }}</td>
                                            <td>{{ $reservacion->evento->nombre }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservacion->fecha_reserva)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservacion->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservacion->hora_fin)->format('H:i') }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $reservacion->estado }}">
                                                    {{ ucfirst($reservacion->estado) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detalleReservacionModal{{ $reservacion->id }}">
                                                                <i class="bi bi-eye"></i> Ver detalles
                                                            </button>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="estado" value="confirmada">
                                                                <button type="submit" class="dropdown-item text-success">
                                                                    <i class="bi bi-check-circle"></i> Confirmar
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="estado" value="completada">
                                                                <button type="submit" class="dropdown-item text-secondary">
                                                                    <i class="bi bi-flag"></i> Marcar completada
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="estado" value="cancelada">
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="bi bi-x-circle"></i> Cancelar
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal de detalles para administrador -->
                                        <div class="modal fade" id="detalleReservacionModal{{ $reservacion->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Detalles de Reservación #{{ $reservacion->id }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <h6>Información del Cliente</h6>
                                                                <p><strong>Nombre:</strong> {{ $reservacion->user->name }}</p>
                                                                <p><strong>Email:</strong> {{ $reservacion->user->email }}</p>
                                                                <p><strong>Teléfono:</strong> {{ $reservacion->user->phone }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h6>Información del Evento</h6>
                                                                <p><strong>Evento:</strong> {{ $reservacion->evento->nombre }}</p>
                                                                <p><strong>Capacidad:</strong> {{ $reservacion->evento->capacidad }} personas</p>
                                                                <p><strong>Precio:</strong> ${{ number_format($reservacion->evento->precio, 2) }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <h6>Detalles de Reservación</h6>
                                                                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($reservacion->fecha_reserva)->format('d/m/Y') }}</p>
                                                                <p><strong>Horario:</strong> {{ \Carbon\Carbon::parse($reservacion->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservacion->hora_fin)->format('H:i') }}</p>
                                                                <p><strong>Estado:</strong> <span class="status-badge status-{{ $reservacion->estado }}">{{ ucfirst($reservacion->estado) }}</span></p>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h6>Notas</h6>
                                                                <p>{{ $reservacion->notas ?: 'Sin notas adicionales' }}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6>Acciones</h6>
                                                                <div class="btn-group">
                                                                    <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST" class="me-2">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="estado" value="confirmada">
                                                                        <button type="submit" class="btn btn-outline-success">
                                                                            <i class="bi bi-check-circle"></i> Confirmar
                                                                        </button>
                                                                    </form>
                                                                    
                                                                    <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST" class="me-2">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="estado" value="completada">
                                                                        <button type="submit" class="btn btn-outline-secondary">
                                                                            <i class="bi bi-flag"></i> Completar
                                                                        </button>
                                                                    </form>
                                                                    
                                                                    <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="estado" value="cancelada">
                                                                        <button type="submit" class="btn btn-outline-danger">
                                                                            <i class="bi bi-x-circle"></i> Cancelar
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <p class="text-muted mb-0">No hay reservaciones disponibles</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginación -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $reservaciones->links() }}
                        </div>
                    </div>
                </div>
            @else
                <!-- Vista de usuario normal -->
                <div class="mb-4">
                    <h1 class="h2">Mis Reservaciones</h1>
                    <p class="text-muted">Gestiona tus reservas de eventos</p>
                </div>

                <!-- Filtros para usuario -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('mis-reservaciones') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                    <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha</label>
                                <input type="date" class="form-control" name="fecha" value="{{ request('fecha') }}">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-dark w-100">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Listado de reservaciones del usuario -->
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @forelse($reservaciones as $reservacion)
                        <div class="col">
                            <div class="card reservation-card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ $reservacion->evento->nombre }}</h5>
                                    <span class="status-badge status-{{ $reservacion->estado }}">
                                        {{ ucfirst($reservacion->estado) }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <p class="text-muted mb-1">Fecha:</p>
                                            <p class="fw-bold">{{ \Carbon\Carbon::parse($reservacion->fecha_reserva)->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-muted mb-1">Horario:</p>
                                            <p class="fw-bold">{{ \Carbon\Carbon::parse($reservacion->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservacion->hora_fin)->format('H:i') }}</p>
                                        </div>
                                    </div>
                                    
                                    @if($reservacion->notas)
                                        <div class="mb-3">
                                            <p class="text-muted mb-1">Notas:</p>
                                            <p>{{ $reservacion->notas }}</p>
                                        </div>
                                    @endif
                                    
                                    <button class="btn btn-outline-dark w-100" data-bs-toggle="modal" data-bs-target="#detalleReservacionModal{{ $reservacion->id }}">
                                        Ver detalles completos
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de detalles para usuario -->
                        <div class="modal fade" id="detalleReservacionModal{{ $reservacion->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Detalles de tu Reservación
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="border-bottom pb-2 mb-3">{{ $reservacion->evento->nombre }}</h6>
                                        
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="text-muted mb-1">Fecha:</p>
                                                <p class="fw-bold">{{ \Carbon\Carbon::parse($reservacion->fecha_reserva)->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted mb-1">Horario:</p>
                                                <p class="fw-bold">{{ \Carbon\Carbon::parse($reservacion->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservacion->hora_fin)->format('H:i') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p class="text-muted mb-1">Estado:</p>
                                                <p><span class="status-badge status-{{ $reservacion->estado }}">{{ ucfirst($reservacion->estado) }}</span></p>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted mb-1">Precio del evento:</p>
                                                <p class="fw-bold">${{ number_format($reservacion->evento->precio, 2) }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <p class="text-muted mb-1">Notas:</p>
                                            <p>{{ $reservacion->notas ?: 'Sin notas adicionales' }}</p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <p class="text-muted mb-1">Detalles del evento:</p>
                                            <p>{{ $reservacion->evento->descripcion }}</p>
                                        </div>
                                        
                                        @if($reservacion->estado === 'pendiente')
                                            <div class="alert alert-warning">
                                                <i class="bi bi-info-circle"></i> Tu reservación está pendiente de confirmación. Te notificaremos cuando sea aprobada.
                                            </div>
                                        @elseif($reservacion->estado === 'confirmada')
                                            <div class="alert alert-success">
                                                <i class="bi bi-check-circle"></i> ¡Tu reservación ha sido confirmada!
                                            </div>
                                        @elseif($reservacion->estado === 'cancelada')
                                            <div class="alert alert-danger">
                                                <i class="bi bi-x-circle"></i> Esta reservación ha sido cancelada.
                                            </div>
                                        @elseif($reservacion->estado === 'completada')
                                            <div class="alert alert-secondary">
                                                <i class="bi bi-flag"></i> Esta reservación ha sido completada. ¡Gracias por tu preferencia!
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        @if($reservacion->estado === 'pendiente' || $reservacion->estado === 'confirmada')
                                            <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="estado" value="cancelada">
                                                <button type="submit" class="btn btn-danger">
                                                    Cancelar reservación
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-5">
                                    <i class="bi bi-calendar-x fs-1 text-muted mb-3"></i>
                                    <h4>No tienes reservaciones</h4>
                                    <p class="text-muted">
                                        Aún no has realizado ninguna reservación. 
                                        ¿Por qué no exploras los eventos disponibles y reservas uno?
                                    </p>
                                    <a href="{{ route('eventos') }}" class="btn btn-dark mt-3">
                                        Ver eventos disponibles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                
                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $reservaciones->links() }}
                </div>
            @endif
        </div>
    </div>

    @include('fragments.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    
    <script>
        // Cerrar alertas automáticamente después de 5 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-light):not(.alert-warning):not(.alert-success):not(.alert-danger):not(.alert-secondary)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeButton = alert.querySelector('.btn-close');
                    if (closeButton) {
                        closeButton.click();
                    }
                }, 5000);
            });
        });
    </script>
</body>
</html>