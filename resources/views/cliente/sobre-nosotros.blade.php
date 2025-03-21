@extends('layouts.cliente')

@section('title', 'Sobre Nosotros - Mitzi Shop')

@section('content')
<style>
    /* Tus estilos actuales */
    .about-section {
        background: rgba(255, 255, 255, 0.9);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1.5s ease-in-out;
    }

    .about-section h2 {
        color: #6a11cb;
        margin-bottom: 1.5rem;
        text-align: center;
        font-size: 2.5rem;
    }

    .about-section h3 {
        color: #6a11cb;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-size: 1.8rem;
    }

    .about-section p {
        color: #333;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .about-section ul {
        list-style-type: none;
        padding-left: 0;
    }

    .about-section ul li {
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .about-section ul li::before {
        content: "•";
        color: #6a11cb;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    .team-section {
        margin-top: 3rem;
    }

    .team-member {
        text-align: center;
        margin-bottom: 2rem;
    }

    .team-member img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        border: 3px solid #6a11cb;
    }

    .team-member h4 {
        color: #6a11cb;
        margin-bottom: 0.5rem;
    }

    .team-member p {
        color: #666;
    }

    .achievements-section {
        margin-top: 3rem;
    }

    .achievements-section h3 {
        text-align: center;
    }

    .achievements-section ul {
        columns: 2;
        -webkit-columns: 2;
        -moz-columns: 2;
    }

    .contact-section {
        margin-top: 3rem;
        text-align: center;
    }

    .contact-section .btn {
        background-color: #6a11cb;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
    }

    .contact-section .btn:hover {
        background-color: #4a0d9b;
    }

    .contact-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    .contact-form button {
        background-color: #6a11cb;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .contact-form button:hover {
        background-color: #4a0d9b;
    }

    .contact-form input[readonly] {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }
</style>

<div class="about-section">
    <h2>Sobre Nosotros</h2>
    <p>
        En <strong>Mitzi Shop</strong>, nos dedicamos a ofrecer las últimas tendencias en moda, combinando estilo, calidad y comodidad. Desde nuestra fundación en 2023, hemos crecido rápidamente gracias a la confianza de nuestros clientes y nuestro compromiso con la excelencia.
    </p>

    <h3>Nuestra Historia</h3>
    <p>
        Mitzi Shop nació de la pasión por la moda y el deseo de ofrecer a nuestros clientes prendas únicas y de alta calidad. Comenzamos como una pequeña tienda local y, gracias al apoyo de nuestra comunidad, nos hemos convertido en un referente en el mundo de la moda.
    </p>

    <h3>Misión</h3>
    <p>
        Nuestra misión es inspirar a las personas a expresar su estilo personal a través de prendas que combinan diseño, calidad y comodidad. Queremos ser la opción preferida de nuestros clientes, ofreciendo una experiencia de compra excepcional.
    </p>

    <h3>Visión</h3>
    <p>
        Aspiramos a ser reconocidos como una marca líder en el mercado de la moda, expandiendo nuestra presencia a nivel nacional e internacional, siempre manteniendo nuestros valores de innovación, sostenibilidad y compromiso con el cliente.
    </p>

    <h3>Valores</h3>
    <ul>
        <li><strong>Calidad:</strong> Ofrecemos productos que superan las expectativas de nuestros clientes.</li>
        <li><strong>Innovación:</strong> Estamos siempre a la vanguardia de las últimas tendencias.</li>
        <li><strong>Sostenibilidad:</strong> Nos comprometemos con prácticas responsables con el medio ambiente.</li>
        <li><strong>Compromiso:</strong> Nuestros clientes son nuestra prioridad.</li>
    </ul>

    <div class="team-section">
        <h3>Nuestro Equipo</h3>
        <div class="row">
            <div class="col-md-4 team-member">
                <img src="{{ asset('img/mitzi.jpg') }}" alt="Miembro del equipo 1">
                <h4>Carlos Caporal</h4>
                <p>Gerente de Ventas</p>
            </div>
            <div class="col-md-4 team-member">
                <img src="{{ asset('img/oscar.png') }}" alt="Miembro del equipo 2">
                <h4>Mitzi Jarquín</h4>
                <p>CEO y Fundadora</p>
            </div>
            <div class="col-md-4 team-member">
                <img src="{{ asset('img/capo.png') }}" alt="Miembro del equipo 3">
                <h4>Oscar Fortino</h4>
                <p>Director de Diseño</p>
            </div>
        </div>
    </div>

    <div class="achievements-section">
        <h3>Logros</h3>
        <ul>
            <li>Más de 10,000 clientes satisfechos.</li>
            <li>Presencia en 5 ciudades principales.</li>
            <li>Premio a la Innovación en Moda 2023.</li>
            <li>Colaboraciones con diseñadores internacionales.</li>
            <li>Compromiso con prácticas sostenibles.</li>
            <li>Lanzamiento de 3 colecciones exclusivas al año.</li>
        </ul>
    </div>

    <div class="contact-section">
        <h3>Contáctanos</h3>
        <p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>

        <!-- Formulario de contacto -->
        <div class="contact-form">
            <form action="{{ route('enviar.consulta') }}" method="POST">
                @csrf
                <input type="text" name="nombre" placeholder="Tu nombre" required>
                <input type="email" name="email" value="{{ Auth::user()->correo }}" readonly>
                <textarea name="mensaje" rows="5" placeholder="Tu mensaje" required></textarea>
                <button type="submit">Enviar mensaje</button>
            </form>
        </div>
    </div>
</div>
@endsection