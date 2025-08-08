<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventum - Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos para los enlaces de navegación */
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            color: #1E3A8A;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #3B82F6;
            transition: all 0.3s ease-out;
        }
        .nav-link:hover {
            color: #3B82F6;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        /* Estilos para el logo */
        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1E40AF;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            margin-right: auto; /* Empuja todo lo demás a la derecha */
        }
        .logo:hover {
            color: #3B82F6;
            transform: scale(1.05);
        }
        /* Efecto de sombra y elevación para el navbar */
        .navbar {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        /* Estilo para el botón de cerrar sesión */
        .logout-button {
            color: #1E40AF;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logout-button:hover {
            color: #3B82F6;
            background-color: #EFF6FF;
            border-radius: 0.375rem;
        }
        
        /* Aseguramos que el contenedor principal ocupe todo el ancho disponible */
        .navbar-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-white fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="navbar-container h-16">
                <!-- Logo con ruta condicional según autenticación -->
                @auth
                    <a href="{{ route('eventos') }}" class="logo">
                        Eventum
                    </a>
                @else
                    <a href="{{ route('mainp') }}" class="logo">
                        Eventum
                    </a>
                @endauth

                <!-- Menú principal con opciones según el rol -->
                <div class="flex items-center space-x-6">
                    <!-- Opción de Eventos con ruta condicional según autenticación -->
                    @auth
                        <a href="{{ route('eventos') }}" class="nav-link">
                            <i class="fa-solid fa-calendar-days"></i>
                            Eventos
                        </a>
                    @else
                        <a href="{{ route('mainp') }}" class="nav-link">
                            <i class="fa-solid fa-calendar-days"></i>
                            Eventos
                        </a>
                    @endauth

                    <!-- Opción de Nosotros siempre visible -->
                    <a href="{{ route('nosotros') }}" class="nav-link">
                        <i class="fa-solid fa-building"></i>
                        Nosotros
                    </a>

                    <a href="{{ route('contacto') }}" class="nav-link">
                        <i class="fa-solid fa-envelope"></i>
                        Contáctanos
                    </a>
                    

                    <!-- Opciones para usuarios no autenticados -->
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Iniciar Sesión
                        </a>
                    @endguest

                    <!-- Opciones para usuarios autenticados -->
                    @auth
                        <!-- Opciones específicas para usuarios regulares -->
                        @if(Auth::user()->isUser())
                            <a href="{{ route('mis-reservaciones') }}" class="nav-link">
                                <i class="fa-solid fa-ticket"></i>
                                Mis Reservaciones
                            </a>
                        @endif

                        <!-- Opciones específicas para administradores -->
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('reservaciones') }}" class="nav-link">
                                <i class="fa-solid fa-ticket-alt"></i>
                                Reservaciones
                            </a>
                            <a href="{{ route('usuarios') }}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                Usuarios
                            </a>
                        @endif

                        <!-- Botón de cerrar sesión siempre visible para usuarios autenticados -->
                        <form action="{{ route('logout') }}" method="GET" class="inline">
                            @csrf
                            <button type="submit" class="logout-button px-3 py-2">
                                <i class="fa-solid fa-sign-out-alt"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</body>
</html>