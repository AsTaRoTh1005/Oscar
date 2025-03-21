@extends('layouts.admin')

@section('title', 'Inicio - Panel de Administración')

@section('content')
<style>
    .welcome-section {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        animation: fadeIn 1s ease-in-out;
    }

    .welcome-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .welcome-section p {
        font-size: 1.2rem;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        animation: slideUp 0.8s ease-in-out;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        color: #666;
    }

    .card-icon {
        font-size: 3rem;
        color: #6a11cb;
        margin-bottom: 1rem;
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

<!-- Sección de Bienvenida -->
<div class="welcome-section">
    <h2>Bienvenido al Panel de Administración</h2>
    <p>Gestiona tu tienda de manera eficiente y mantén todo bajo control.</p>
</div>

<!-- Tarjetas Informativas -->
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h5 class="card-title"><i class="bi bi-people"></i> Usuarios Registrados</h5>
                <p class="card-text">Gestiona los usuarios de tu tienda.</p>
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Ver Usuarios</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <h5 class="card-title"><i class="bi bi-box2"></i> Productos</h5>
                <p class="card-text">Administra tu catálogo de productos.</p>
                <a href="{{ route('producto.index') }}" class="btn btn-primary">Ver Productos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <h5 class="card-title"><i class="bi bi-buildings"></i> Proveedores</h5>
                <p class="card-text">Administra tu catálogo de proveedores.</p>
                <a href="{{ route('proveedor.index') }}" class="btn btn-primary">Ver Proveedores</a>
            </div>
        </div>
    </div>
</div>

<!-- Información de la Tienda -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h3>Sobre Nosotros</h3>
            <p>
                En <strong>Mitzí Tienda</strong>, nos dedicamos a ofrecer las últimas tendencias en moda. Nuestra misión es brindarte prendas de alta calidad que combinen estilo y comodidad. Desde ropa casual hasta outfits elegantes, tenemos todo lo que necesitas para lucir increíble en cualquier ocasión.
            </p>
        </div>
        <div class="col-md-6">
            <h3>Nuestros Servicios</h3>
            <ul>
                <li>Envío rápido y seguro a todo el país.</li>
                <li>Devoluciones gratuitas dentro de los 30 días.</li>
                <li>Atención al cliente 24/7.</li>
                <li>Promociones exclusivas para nuestros clientes frecuentes.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection