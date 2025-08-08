<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración de Usuarios | Salón de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        @keyframes slideInRight {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .card-header-admin {
            background-color: #343a40;
            color: white;
            padding: 1rem;
            border-radius: 0.375rem 0.375rem 0 0;
        }
        .user-list-container {
            max-height: 500px;
            overflow-y: auto;
        }
        .btn-admin {
            background-color: #343a40;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-admin:hover {
            background-color: #212529;
            color: white;
        }
        .role-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .role-admin {
            background-color: #dc3545;
            color: white;
        }
        .role-usuario {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>
    @include('fragments.navbar')

    <div class="container admin-container py-5 my-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h1 class="fw-bold text-center">Administración de Usuarios</h1>
                <p class="text-center text-muted">Gestiona los usuarios del sistema</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Columna izquierda: Lista de usuarios -->
            <div class="col-lg-7">
                <div class="card border-0 shadow">
                    <div class="card-header-admin">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="m-0">Usuarios Registrados</h3>
                            <div class="input-group mb-0" style="max-width: 250px;">
                                <input type="text" id="searchUser" class="form-control form-control-sm ps-3" placeholder="Buscar usuarios...">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="user-list-container">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-usuario' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                                    data-id="{{ $user->id }}" 
                                                    data-name="{{ $user->name }}" 
                                                    data-email="{{ $user->email }}" 
                                                    data-phone="{{ $user->phone }}" 
                                                    data-role="{{ $user->role }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro que deseas eliminar este usuario?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">No hay usuarios registrados</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna derecha: Formulario de creación de usuario -->
            <div class="col-lg-5">
                <div class="card border-0 shadow slide-in-right">
                    <div class="card-header-admin">
                        <h3 class="m-0">Crear Nuevo Usuario</h3>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Formulario para crear usuario -->
                        <form action="{{ route('usuarios.store') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" required placeholder="Nombre completo" value="{{ old('name') }}">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" required placeholder="Correo electrónico" value="{{ old('email') }}">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="input-group">
                                <input type="tel" name="phone" class="form-control" required placeholder="Teléfono" value="{{ old('phone') }}">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="input-group">
                                <select name="role" class="form-control" required>
                                    <option value="" disabled selected>Seleccionar rol</option>
                                    <option value="usuario" {{ old('role') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                </select>
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" required placeholder="Contraseña">
                                <i class="bi bi-lock"></i>
                            </div>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirmar contraseña">
                                <i class="bi bi-lock-fill"></i>
                            </div>
                            <button type="submit" class="btn btn-admin w-100 py-2">
                                <i class="bi bi-person-plus me-2"></i>Crear Usuario
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <input type="text" name="name" id="edit_name" class="form-control" required placeholder="Nombre completo">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="input-group">
                            <input type="email" name="email" id="edit_email" class="form-control" required placeholder="Correo electrónico">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="input-group">
                            <input type="tel" name="phone" id="edit_phone" class="form-control" required placeholder="Teléfono">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="input-group">
                            <select name="role" id="edit_role" class="form-control" required>
                                <option value="usuario">Usuario</option>
                                <option value="admin">Administrador</option>
                            </select>
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Nueva contraseña (dejar en blanco para mantener)">
                            <i class="bi bi-lock"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar nueva contraseña">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('fragments.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script>
        // Script para manejar la edición de usuarios en el modal
        document.addEventListener('DOMContentLoaded', function() {
            const editUserModal = document.getElementById('editUserModal');
            if (editUserModal) {
                editUserModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-id');
                    const userName = button.getAttribute('data-name');
                    const userEmail = button.getAttribute('data-email');
                    const userPhone = button.getAttribute('data-phone');
                    const userRole = button.getAttribute('data-role');
                    
                    // Actualizar los campos del formulario
                    document.getElementById('edit_name').value = userName;
                    document.getElementById('edit_email').value = userEmail;
                    document.getElementById('edit_phone').value = userPhone;
                    document.getElementById('edit_role').value = userRole;
                    
                    // Actualizar la acción del formulario
                    document.getElementById('editUserForm').action = `/usuarios/${userId}`;
                });
            }
            
            // Funcionalidad de búsqueda de usuarios
            const searchUser = document.getElementById('searchUser');
            if (searchUser) {
                searchUser.addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase();
                    const tableRows = document.querySelectorAll('tbody tr');
                    
                    tableRows.forEach(row => {
                        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        
                        if (name.includes(searchValue) || email.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>