@extends('layouts.cliente')

@section('title', 'Inicio - Mitzi Shop')

@section('content')
<style>
    /* Estilos para el carrusel */
    .carousel-item img {
        height: 400px;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 10px;
    }

    /* Animaciones */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .welcome-text {
        animation: fadeIn 1.5s ease-in-out;
    }
</style>

<!-- Carrusel de Imágenes -->
<div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://cdn.pixabay.com/photo/2016/11/22/19/08/hangers-1850082_1280.jpg" class="d-block w-100" alt="Moda Verano 2023">
            <div class="carousel-caption d-none d-md-block">
                <h2>Moda Verano 2023</h2>
                <p>Descubre las últimas tendencias para este verano.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://cdn.pixabay.com/photo/2019/03/01/02/48/store-4027251_640.jpg" class="d-block w-100" alt="Ofertas Especiales">
            <div class="carousel-caption d-none d-md-block">
                <h2>Ofertas Especiales</h2>
                <p>Aprovecha nuestras promociones exclusivas.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://cdn.pixabay.com/photo/2017/06/21/20/51/tshirt-2428521_640.jpg" class="d-block w-100" alt="Nueva Colección">
            <div class="carousel-caption d-none d-md-block">
                <h2>Nueva Colección</h2>
                <p>Explora nuestra nueva colección de otoño.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<!-- Texto de Bienvenida -->
<div class="welcome-text text-center mb-5">
    <h2>Bienvenido a Mitzi Shop</h2>
    <p>Tu destino para encontrar las últimas tendencias en moda. Ofrecemos una amplia variedad de productos para hombres, mujeres y niños.</p>
</div>
@endsection