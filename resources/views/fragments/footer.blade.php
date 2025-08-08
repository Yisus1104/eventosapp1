<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventum - Footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos generales del footer */
        .footer {
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1), 0 -2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        /* Estilos para el logo del footer */
        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1E40AF;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }

        .footer-logo:hover {
            color: #3B82F6;
            transform: scale(1.05);
        }

        /* Estilos para los enlaces del footer */
        .footer-link {
            position: relative;
            color: #1E3A8A;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #3B82F6;
            transition: all 0.3s ease-out;
        }

        .footer-link:hover {
            color: #3B82F6;
        }

        .footer-link:hover::after {
            width: 100%;
        }

        /* Estilos para íconos sociales */
        .social-icon {
            color: #1E40AF;
            transition: all 0.3s ease;
            font-size: 1.25rem;
        }

        .social-icon:hover {
            color: #3B82F6;
            transform: scale(1.2);
        }

        /* Estilos para el copyright */
        .copyright {
            color: #6B7280;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <footer class="footer bg-white w-full mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-8">
                <!-- Sección superior con logo, enlaces y redes sociales -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <!-- Logo -->
                    <div class="mb-6 md:mb-0">
                        <a href="#" class="footer-logo">
                            Eventum
                        </a>
                        <p class="text-gray-600 mt-2 max-w-md">
                            Tu plataforma de gestión de eventos profesionales. Crea, organiza y vive experiencias inolvidables.
                        </p>
                    </div>

                    <!-- Enlaces principales -->
                    <div class="flex flex-col mb-6 md:mb-0">
                        <h3 class="font-semibold text-blue-900 mb-4">Enlaces Rápidos</h3>
                        <div class="flex flex-col space-y-3">
                            <a href="#" class="footer-link">
                                <i class="fa-solid fa-calendar-days mr-2"></i>
                                Eventos
                            </a>
                            <a href="#" class="footer-link">
                                <i class="fa-solid fa-building mr-2"></i>
                                Nosotros
                            </a>
                            <a href="#" class="footer-link">
                                <i class="fa-solid fa-envelope mr-2"></i>
                                Contacto
                            </a>
                        </div>
                    </div>



                    <!-- Redes sociales -->
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-blue-900 mb-4">Síguenos</h3>
                        <div class="flex space-x-5">
                            <a href="#" class="social-icon" aria-label="Facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="Twitter">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="LinkedIn">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </footer>
</body>
</html>