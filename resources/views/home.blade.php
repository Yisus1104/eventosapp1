<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salón de Eventos | Tu Celebración Perfecta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://via.placeholder.com/1920x1080');
            background-size: cover;
            background-position: center;
            height: 600px;
        }
        .popular-event-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        .event-card {
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .popular-event-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
        font-size: 0.8rem;
    }
    
    .event-card .card-img-top {
        transition: transform 0.5s ease;
    }
    
    .event-card:hover .card-img-top {
        transform: scale(1.05);
    }
    </style>
</head>

<body>
    @include('fragments.navbar')

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center mb-5">
        <div class="container text-center text-white">
            <h1 class="display-2 fw-bold mb-4">Celebra tus momentos especiales</h1>
            <p class="fs-4 mb-5">El mejor salón de eventos para todas tus celebraciones</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 me-3">Reservar ahora</a>
            <a href="#eventos" class="btn btn-outline-light btn-lg px-5 py-3">Ver eventos</a>
        </div>
    </section>



<!-- EVENTOS POPULARES - Version Mejorada -->
<section id="eventos" class="py-5 mb-5">
    <div class="container">
        <h2 class="text-center display-5 fw-bold mb-5">Eventos Más Populares</h2>
        <div class="row g-4">
            @forelse ($eventosPopulares as $evento)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 event-card border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            @if ($evento->imagen)
                                <img src="{{ asset('storage/' . $evento->imagen) }}" class="card-img-top object-cover" style="height: 220px;" alt="{{ $evento->nombre }}">
                            @else
                                <img src="https://via.placeholder.com/800x600?text=Sin+Imagen" class="card-img-top object-cover" style="height: 220px;" alt="{{ $evento->nombre }}">
                            @endif

                        </div>
                        <div class="card-body p-4">
                            <h3 class="card-title h5 fw-bold mb-3">{{ $evento->nombre }}</h3>
                            <p class="card-text text-muted mb-4 small">{{ Str::limit($evento->descripcion, 100) }}</p>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('login') }}" class="btn btn-primary fw-semibold flex-grow-1 rounded-3">
                                    <i class="bi bi-calendar-check me-1"></i> Reservar
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="p-5 bg-light rounded-4 shadow-sm">
                        <i class="bi bi-calendar-x display-4 text-muted mb-3"></i>
                        <p class="lead">No hay eventos disponibles en este momento.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>



    <!-- Testimonios Section -->
    <section class="bg-light py-5 mb-5">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-5">Lo que dicen nuestros clientes</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Testimonio 1 -->
                            <div class="carousel-item active">
                                <div class="card border-0 shadow p-4">
                                    <div class="d-flex justify-content-center mb-4">
                                        <span class="text-warning fs-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="lead fst-italic mb-4">"Nuestra boda fue un sueño hecho realidad gracias al profesionalismo y dedicación del equipo. El salón lucía espectacular y todos nuestros invitados quedaron encantados."</p>
                                        <h5 class="fw-bold mb-1">María y Carlos</h5>
                                        <p class="text-muted">Boda - Marzo 2025</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonio 2 -->
                            <div class="carousel-item">
                                <div class="card border-0 shadow p-4">
                                    <div class="d-flex justify-content-center mb-4">
                                        <span class="text-warning fs-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="lead fst-italic mb-4">"La fiesta de XV años de mi hija fue perfecta. La decoración, la comida y el servicio superaron nuestras expectativas. Definitivamente lo recomendaría."</p>
                                        <h5 class="fw-bold mb-1">Laura Mendoza</h5>
                                        <p class="text-muted">XV Años - Enero 2025</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonio 3 -->
                            <div class="carousel-item">
                                <div class="card border-0 shadow p-4">
                                    <div class="d-flex justify-content-center mb-4">
                                        <span class="text-warning fs-3">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="lead fst-italic mb-4">"Organizamos un evento corporativo y todo salió genial. Las instalaciones son modernas y el equipo técnico funcionó perfectamente. Los asistentes quedaron muy satisfechos."</p>
                                        <h5 class="fw-bold mb-1">Roberto Jiménez</h5>
                                        <p class="text-muted">Evento Corporativo - Febrero 2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="reservar" class="container mb-5 py-5">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-4">Reserva tu evento hoy mismo</h2>
                <p class="lead mb-5">Nuestro equipo está listo para ayudarte a planificar el evento de tus sueños. Contáctanos para recibir una cotización personalizada.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 me-sm-3 mb-3 mb-sm-0">Reservar ahora</a>
                </div>
            </div>
        </div>
    </section>


    @include('fragments.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>