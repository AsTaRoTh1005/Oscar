<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: rgba(0, 0, 0, 0.7);
            padding: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.8s ease-in-out;
        }

        header h1 {
            font-size: 2rem;
            margin: 0;
            color: #fff;
        }

        header .nav {
            margin-top: 1rem;
        }

        header .nav-link {
            color: #fff !important;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        header .nav-link:hover {
            color: #6a11cb !important;
            transform: translateY(-3px);
        }

        /* Botón de Cerrar Sesión en el Navbar */
        .logout-button {
            background: none;
            border: none;
            color: #fff !important;
            font-size: 1rem;
            cursor: pointer;
            transition: color 0.3s ease, transform 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .logout-button:hover {
            color: #ff4757 !important;
            transform: translateY(-3px);
        }

        /* Contenido Principal */
        main {
            flex: 1;
            padding: 2rem 0;
            animation: fadeIn 1s ease-in-out;
        }

        main .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.7);
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.8s ease-in-out;
        }

        footer p {
            margin: 0;
            color: #fff;
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

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Panel de Administración</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminHome') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('producto.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categoria.index') }}">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proveedor.index') }}">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                    </li>
                    <!-- Botón de Cerrar Sesión -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf <!-- Token CSRF para protección -->
                            <button type="submit" class="logout-button">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main>
        <div class="container">
            @yield('content') <!-- Aquí se insertará el contenido de cada vista -->
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Mitzi Shop. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts personalizados -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>