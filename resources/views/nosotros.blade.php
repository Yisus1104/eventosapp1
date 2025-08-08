<!-- resources/views/nosotros.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nosotros | Salón de Eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://via.placeholder.com/1920x1080');
            background-size: cover;
            background-position: center;
            height: 400px;
        }
        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    @include('fragments.navbar')

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center mb-5">
        <div class="container text-center text-white">
            <h1 class="display-3 fw-bold mb-4">Nuestra Historia</h1>
            <p class="fs-5 mb-3">Conoce quiénes somos y por qué somos la mejor opción para tu evento</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="container py-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://elolivar.es/olivar-content/uploads/2021/06/salones-para-eventos.png" alt="Nuestro Salón de Eventos" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Creando momentos inolvidables desde 2010</h2>
                <p class="lead mb-4">En nuestro salón de eventos nos especializamos en convertir momentos especiales en recuerdos inolvidables. Con más de 15 años de experiencia en la industria, hemos perfeccionado el arte de la celebración.</p>
                <p class="mb-4">Nuestro compromiso con la excelencia y la atención personalizada nos ha permitido ganar la confianza de cientos de clientes que han elegido nuestros espacios para sus momentos más importantes.</p>
                <div class="row g-4 mt-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Experiencia</h5>
                                <p class="mb-0">15+ años en el sector</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-trophy-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Calidad</h5>
                                <p class="mb-0">Servicio premium</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Equipo</h5>
                                <p class="mb-0">Personal cualificado</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-heart-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Pasión</h5>
                                <p class="mb-0">Amor por los detalles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section with Google Map -->
    <section class="bg-light py-5 mb-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-4">Nuestra Ubicación</h2>
                    <p class="lead mb-0">Estamos estratégicamente ubicados en el corazón de la ciudad, con fácil acceso y amplias instalaciones para que tu evento sea un éxito.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body p-0">
                            <!-- Google Maps iframe (placeholder) -->
                            <div class="ratio ratio-21x9">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.952912260219!2d3.375295414770757!3d6.5276300452169445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8b2ae68280c1%3A0xdc9e87a367c3d9cb!2sLagos%2C%20Nigeria!5e0!3m2!1sen!2s!4v1650918480882!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="card-footer bg-white p-4">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt-fill text-primary fs-3 me-3"></i>
                                        <div>
                                            <h5 class="fw-bold mb-0">Dirección</h5>
                                            <p class="mb-0">Av. Principal #123, Ciudad</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone-fill text-primary fs-3 me-3"></i>
                                        <div>
                                            <h5 class="fw-bold mb-0">Teléfono</h5>
                                            <p class="mb-0">+123 456 7890</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope-fill text-primary fs-3 me-3"></i>
                                        <div>
                                            <h5 class="fw-bold mb-0">Email</h5>
                                            <p class="mb-0">info@eventum.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('fragments.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>