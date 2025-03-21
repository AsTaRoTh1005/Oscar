<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Contenedor principal */
        .auth-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* Título */
        .auth-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1.5rem;
            animation: slideDown 0.8s ease-in-out;
        }

        /* Formularios */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            animation: fadeIn 1s ease-in-out;
        }

        .auth-form.hidden {
            display: none;
        }

        /* Grupos de formulario */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-size: 0.9rem;
            color: #555;
        }

        .form-group input {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.5);
            outline: none;
        }

        /* Botón de acción */
        .auth-button {
            padding: 0.8rem;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .auth-button:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        /* Botón de Google */
        .google-button {
            padding: 0.8rem;
            background: #ffffff;
            color: #000000;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .google-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .google-button img {
            width: 20px;
            height: 20px;
        }

        /* Botón de alternar */
        .auth-toggle {
            margin-top: 1.5rem;
        }

        .toggle-button {
            background: none;
            border: none;
            color: #6a11cb;
            font-size: 0.9rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .toggle-button:hover {
            color: #2575fc;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Encabezado -->
        <h1 class="auth-title" id="authTitle">Iniciar Sesión</h1>
        
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
        @endif

        <!-- Formulario de Inicio de Sesión -->
        <form id="loginForm" action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" required>
            </div>
            <button type="submit" class="auth-button">Iniciar Sesión</button>
            <button type="button" class="google-button" onclick="window.location.href='{{ url('/login/google') }}'">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/800px-Google_%22G%22_logo.svg.png" alt="">
                Iniciar sesión con Google
            </button>
        </form>

        <!-- Formulario de Registro -->
        <form id="registerForm" action="{{ route('register') }}" method="POST" class="auth-form hidden">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" name="apellidoP" id="apellidoP" required>
            </div>
            <div class="form-group">
                <label for="apellidoM">Apellido Materno</label>
                <input type="text" name="apellidoM" id="apellidoM" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" required>
            </div>
            <div class="form-group">
                <label for="contraseña_confirmation">Confirmar Contraseña</label>
                <input type="password" name="contraseña_confirmation" id="contraseña_confirmation" required>
            </div>
            <button type="submit" class="auth-button">Registrarse</button>
        </form>

        <!-- Botón para Cambiar entre Inicio de Sesión y Registro -->
        <div class="auth-toggle">
            <button id="toggleButton" class="toggle-button">¿No tienes una cuenta? Regístrate</button>
        </div>
    </div>

    <script>
        // JavaScript para alternar entre los formularios
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const authTitle = document.getElementById('authTitle');
        const toggleButton = document.getElementById('toggleButton');

        toggleButton.addEventListener('click', () => {
            loginForm.classList.toggle('hidden');
            registerForm.classList.toggle('hidden');
            authTitle.textContent = registerForm.classList.contains('hidden') ? 'Iniciar Sesión' : 'Registrarse';
            toggleButton.textContent = registerForm.classList.contains('hidden') ? '¿No tienes una cuenta? Regístrate' : '¿Ya tienes una cuenta? Inicia Sesión';
        });
    </script>
</body>
</html>