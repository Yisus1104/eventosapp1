<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro | Salón de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .register-image-side {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&q=80&w=1470');
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
        .welcome-badge {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        .welcome-text-container {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .cta-button {
            border: 2px solid white;
            background-color: transparent;
            color: white;
            border-radius: 30px;
            padding: 8px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 15px;
            display: inline-block;
        }
        .cta-button:hover {
            background-color: white;
            color: #333;
        }
        .welcome-icon {
            font-size: 3rem;
            margin-bottom: 0.75rem;
            color: #fff;
        }
    </style>
</head>

<body>
    @include('fragments.navbar')

    <div class="container py-20 my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow overflow-hidden">
                    <div class="row g-0">
                        <!-- Lado izquierdo con imagen de fondo -->
                        <div class="col-md-6 d-none d-md-block register-image-side">
                            <div class="d-flex flex-column justify-content-center h-100 text-white text-center p-4 slide-in-left welcome-content">
                                <div class="welcome-text-container">
                                    <h2 class="display-6 fw-bold mb-3">¡Únete a nosotros!</h2>
                                    <p class="lead mb-4">Crea tu cuenta para comenzar a planificar tus eventos especiales</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lado derecho con formulario -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-md-5 slide-in-right">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold mb-2">Crear Cuenta</h2>
                                    <p class="text-muted">Completa el formulario para registrarte</p>
                                    
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
                                
                                <form class="mb-4" action="{{ route('validar-registro') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" required placeholder="Nombre completo">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" required placeholder="Correo electrónico">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="input-group">
                                        <input type="tel" name="phone" class="form-control" required placeholder="Teléfono">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" required placeholder="Contraseña">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirmar contraseña">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                                        Registrarse
                                    </button>
                                </form>
                                
                                <p class="text-center">
                                    ¿Ya tienes una cuenta? 
                                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                        Inicia sesión aquí
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