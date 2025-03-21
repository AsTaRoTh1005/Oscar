@extends('layouts.cliente')

@section('title', 'Productos - Mitzi Shop')

@section('content')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        background: #fff;
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        color: #666;
    }

    .btn-ver-mas {
        background-color: #6a11cb;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-ver-mas:hover {
        background-color: #2575fc;
    }

    .modal-content {
        border-radius: 15px;
    }

    .modal-header {
        background-color: #6a11cb;
        color: white;
        border-bottom: none;
    }

    .modal-body img {
        max-width: 100%;
        border-radius: 10px;
    }

    .modal-body h5 {
        color: #6a11cb;
    }

    .modal-body p {
        color: #333;
    }

    .modal-footer {
        border-top: none;
    }
</style>

<h2 class="text-center mb-4">Nuestros Productos</h2>
<div class="row">
    @foreach ($productos as $producto)
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
            <div class="card-body">
                <h5 class="card-title">{{ $producto->nombre }}</h5>
                <p class="card-text">{{ $producto->descripcion }}</p>
                <p class="card-text"><strong>${{ number_format($producto->precio, 2) }}</strong></p>
                <button class="btn btn-ver-mas" data-bs-toggle="modal" data-bs-target="#modalProducto{{ $producto->id_producto }}">
                    Ver Detalles
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para cada producto -->
    <div class="modal fade" id="modalProducto{{ $producto->id_producto }}" tabindex="-1" aria-labelledby="modalLabel{{ $producto->id_producto }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel{{ $producto->id_producto }}">{{ $producto->nombre }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
                        </div>
                        <div class="col-md-6">
                            <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                            <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                            <p><strong>Stock:</strong> {{ $producto->stock }}</p>
                            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre_categoria }}</p>
                            <p><strong>Proveedor:</strong> {{ $producto->proveedor->nombre_proveedor }}</p>
                            <!-- Formulario para hacer el pedido -->
                            <form id="formPedido{{ $producto->id_producto }}" class="mt-3">
                                @csrf
                                <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                                <div class="mb-3">
                                    <label for="cantidad{{ $producto->id_producto }}" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad{{ $producto->id_producto }}" name="cantidad" min="1" max="{{ $producto->stock }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Bootstrap JS y jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Enviar formulario de pedido
    $('[id^=formPedido]').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let url = "{{ route('pedidos.store') }}";
        let data = form.serialize();

        $.post(url, data, function (response) {
            if (response.success) {
                alert('Pedido realizado con éxito.');
                location.reload(); // Recargar la página para actualizar el stock
            } else {
                alert(response.message);
            }
        }).fail(function (response) {
            alert('Error al realizar el pedido.');
            console.error(response); // Mostrar el error en la consola
        });
    });
});
</script>
@endsection