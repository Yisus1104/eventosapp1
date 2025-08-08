<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3B82F6', // Azul
                        'primary-light': '#60A5FA', // Azul más claro
                        'primary-dark': '#2563EB', // Azul más oscuro
                        'dark-text': '#1E293B',
                        'light-text': '#64748B',
                    },
                    animation: {
                        'float': 'float 4s ease-in-out infinite',
                        'fadeInUp': 'fadeInUp 0.8s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        fadeInUp: {
                            'from': { 
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            'to': { 
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Estilos base */
        .bg-gradient {
            background: linear-gradient(135deg, #EFF6FF 0%, #BFDBFE 100%);
        }
        .text-gradient {
            background: linear-gradient(45deg, #2563EB, #60A5FA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Form styles */
        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #E2E8F0;
        }
        .form-input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }
        .form-input:hover:not(:focus) {
            border-color: #93C5FD;
        }
        
        /* Button styles */
        .btn-primary-gradient {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .btn-primary-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #60A5FA, #3B82F6);
            transition: all 0.5s ease;
            z-index: -1;
        }
        .btn-primary-gradient:hover::before {
            left: 0;
        }
        .btn-primary-gradient:active {
            transform: scale(0.98);
        }
        
        /* Aseguramos que el contenido principal tenga suficiente margen respecto al navbar */
        .content-wrapper {
            padding-top: 3rem; /* Aumentamos el padding superior */
            margin-top: 2rem; /* Añadimos margen adicional */
        }
        
        /* Glassmorphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Añadimos un delay para escalonar las animaciones */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
    </style>
</head>
<body class="font-sans bg-gradient min-h-screen m-0 p-0 text-dark-text">
    @include('fragments.navbar')

    <div class="content-wrapper relative">
        <section class="py-16 relative">
            <div class="container mx-auto px-4">
                <h1 class="text-5xl font-bold mb-6 text-center text-gradient">Contáctanos</h1>
                <p class="text-xl mb-10 text-light-text max-w-2xl mx-auto text-center leading-relaxed animate-fadeInUp">
                    ¿Tienes alguna pregunta o comentario? Nos encantaría escucharte y ayudarte en lo que necesites.
                </p>

                <div class="max-w-2xl mx-auto p-10 glass-effect rounded-3xl shadow-lg transform transition-all duration-500 hover:shadow-xl">
                    @if(session('success'))
                        <div class="bg-blue-50 text-blue-700 p-4 rounded-lg mb-6 animate-fadeInUp">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="mb-6 relative animate-fadeInUp delay-100">
                            <label for="name" class="block mb-2 font-medium text-dark-text">Nombre:</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-primary opacity-70">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" name="name" id="name" 
                                    class="w-full form-input bg-white bg-opacity-80 rounded-2xl py-4 pl-10 pr-5 text-base focus:outline-none"
                                    required>
                            </div>
                        </div>
                        
                        <div class="mb-6 relative animate-fadeInUp delay-200">
                            <label for="email" class="block mb-2 font-medium text-dark-text">Correo electrónico:</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-primary opacity-70">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" 
                                    class="w-full form-input bg-white bg-opacity-80 rounded-2xl py-4 pl-10 pr-5 text-base focus:outline-none"
                                    required>
                            </div>
                        </div>
                        
                        <div class="mb-6 relative animate-fadeInUp delay-300">
                            <label for="message" class="block mb-2 font-medium text-dark-text">Mensaje:</label>
                            <div class="relative">
                                <span class="absolute left-4 top-6 text-primary opacity-70">
                                    <i class="bi bi-chat-quote"></i>
                                </span>
                                <textarea name="message" id="message" 
                                    class="w-full form-input bg-white bg-opacity-80 rounded-2xl py-4 pl-10 pr-5 text-base focus:outline-none min-h-40 resize-y"
                                    required></textarea>
                            </div>
                        </div>
                        
                        <div class="animate-fadeInUp delay-400">
                            <button type="submit" 
                                class="w-full py-4 px-10 text-lg font-semibold text-white btn-primary-gradient rounded-full transition-all duration-300 hover:shadow-lg group">
                                <span class="inline-flex items-center justify-center">
                                    <span>Enviar</span>
                                    <i class="bi bi-send ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            
            
            <!-- Se eliminaron los iconos flotantes que se superponían -->
        </section>
    </div>

    @include('fragments.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>