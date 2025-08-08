<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404 - Página no encontrada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            background-color: white;
            padding: 4rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }
        .error-number {
            font-size: 8rem;
            font-weight: 200;
            line-height: 1;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }
        .four {
            font-weight: 300;
        }
        .zero {
            display: inline-block;
            background-color: black;
            color: white;
            border-radius: 50%;
            width: 7.5rem;
            height: 7.5rem;
            line-height: 7.5rem;
            margin: 0 -0.5rem;
        }
        .error-message {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 2rem;
        }
        .underline {
            text-decoration: underline;
            text-decoration-thickness: 2px;
        }
        .go-back-btn {
            background-color: #ff3b30;
            color: white;
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .go-back-btn:hover {
            background-color: #e02e24;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 59, 48, 0.3);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-number">
            <span class="four">4</span>
            <span class="zero">0</span>
            <span class="four">4</span>
        </div>
        <p class="error-message">No <span class="underline">encontramos</span> la página que buscas.</p>
        <a id="goBackBtn" class="go-back-btn">Volver</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const goBackBtn = document.getElementById('goBackBtn');
            goBackBtn.addEventListener('click', function() {
                // Verificar si el usuario está autenticado (esta lógica se completará con PHP)
                // El código PHP real se implementará en el archivo blade
                window.location.href = "{{ Auth::check() ? route('eventos') : route('mainp') }}";
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>