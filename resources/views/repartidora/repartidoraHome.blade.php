@extends('layouts.repartidora')

@section('title', 'Pedidos - Repartidora')

@section('content')
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }
    .table th {
        background-color: #6a11cb;
        color: white;
    }
    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .table tr:hover {
        background-color: #ddd;
    }
    .btn-actualizar {
        background-color: #2575fc;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-actualizar:hover {
        background-color: #1a5bbf;
    }
</style>

<h2 class="text-center mb-4">Lista de Pedidos</h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id_pedido }}</td>
                <td>{{ $pedido->usuario->nombre }}</td>
                <td>{{ $pedido->fecha_pedido }}</td>
                <td>${{ number_format($pedido->total, 2) }}</td>
                <td>
                    <select class="form-select estado-pedido" data-id="{{ $pedido->id_pedido }}">
                        <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Enviado" {{ $pedido->estado == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                        <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-actualizar" onclick="actualizarEstado({{ $pedido->id_pedido }})">Actualizar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS y jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function actualizarEstado(idPedido) {
    // Obtener el nuevo estado seleccionado
    let nuevoEstado = $(`.estado-pedido[data-id="${idPedido}"]`).val();

    // Enviar la solicitud AJAX para actualizar el estado
    $.ajax({
        url: `/repartidora/pedidos/${idPedido}/actualizar-estado`,
        type: 'PUT',
        data: {
            _token: "{{ csrf_token() }}",
            estado: nuevoEstado
        },
        success: function (response) {
            if (response.success) {
                alert('Estado actualizado con éxito.');
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert('Error al actualizar el estado.');
            }
        },
        error: function (response) {
            alert('Error al actualizar el estado.');
            console.error(response); // Mostrar el error en la consola
        }
    });
}
</script>
@endsection