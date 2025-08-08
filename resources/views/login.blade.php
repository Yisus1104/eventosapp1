<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión | Salón de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .login-image-side {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .welcome-content {
            position: relative;
            z-index: 2;
        }
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .input-group input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        .input-group input:focus {
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
        .social-btn:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }
        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        @keyframes slideInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideInRight {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .welcome-image {
            max-width: 180px;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body>
    @include('fragments.navbar')

    <!-- Mostrar mensaje de éxito si existe -->
    @if(session('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="container py-20 my-10">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow overflow-hidden">
                    <div class="row g-0">
                        <!-- Lado izquierdo con imagen -->
                        <div class="col-md-6 d-none d-md-block login-image-side">
                            <div class="d-flex flex-column justify-content-center h-100 text-white text-center p-4 slide-in-left welcome-content">
                                <div class="welcome-image">
                                </div>
                                <h2 class="display-6 fw-bold mb-3">¡Bienvenido de vuelta!</h2>
                                <p class="lead">Accede a tu cuenta para gestionar tus reservas y eventos especiales</p>
                            </div>
                        </div>
                        
                        <!-- Lado derecho con formulario -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-md-5 slide-in-right">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold mb-2">Iniciar Sesión</h2>
                                    <p class="text-muted">Ingresa tus credenciales para continuar</p>
                                    
                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                                
                                <form method="POST" action="{{ route('inicia-sesion') }}" class="mb-4">
                                    @csrf
                                    <div class="input-group">
                                        <input type="email" 
                                               name="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               required 
                                               placeholder="Correo electrónico"
                                               value="{{ old('email') }}"
                                               autofocus>
                                        <i class="bi bi-envelope"></i>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group">
                                        <input type="password" 
                                               name="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               required 
                                               placeholder="Contraseña">
                                        <i class="bi bi-lock"></i>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Recordarme</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                        Iniciar Sesión
                                    </button>
                                </form>
                                
                                <p class="text-center">
                                    ¿No tienes una cuenta? 
                                    <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                        Regístrate aquí
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('fragments.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>