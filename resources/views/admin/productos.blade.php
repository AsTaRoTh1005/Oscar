@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
<style>
    #buscador {
        max-width: 250px;
    }

    .btn-pulse {
        animation: pulse 2s infinite;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
        transition: background-color 0.3s ease;
    }

    .img-producto {
        max-width: 50px;
        max-height: 50px;
        border-radius: 5px;
    }
</style>

<div class="container mt-4">
    <h1 class="text-center">Productos</h1>

    <!-- Botón para abrir modal de agregar producto y buscador -->
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscador" class="form-control w-25 me-auto" placeholder="Buscar producto...">
        <button class="btn btn-success btn-pulse" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Producto</button>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaProductos">
                @foreach ($productos as $producto)
                <tr id="producto_{{ $producto->id_producto }}">
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-producto">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $producto->categoria->nombre_categoria }}</td>
                    <td>{{ $producto->proveedor->nombre_proveedor }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editar" data-id="{{ $producto->id_producto }}" data-bs-toggle="modal" data-bs-target="#modalEditar"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="{{ $producto->id_producto }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PARA AGREGAR PRODUCTO -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregar" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="id_categoria" required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Proveedor</label>
                        <select class="form-select" name="id_proveedor" required>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre_proveedor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDITAR PRODUCTO -->
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditar" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id_producto">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="editDescripcion" name="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="editPrecio" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" id="editStock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                        <small class="text-muted">Deja este campo vacío si no deseas cambiar la imagen.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" id="editCategoria" name="id_categoria" required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Proveedor</label>
                        <select class="form-select" id="editProveedor" name="id_proveedor" required>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre_proveedor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA ELIMINAR PRODUCTO -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminar">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Buscador
    $('#buscador').on('keyup', function () {
        let valor = $(this).val().toLowerCase();
        $('#tablaProductos tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });

    // AGREGAR PRODUCTO
    $('#formAgregar').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this); // Crear un FormData para enviar archivos

        $.ajax({
            url: "{{ route('producto.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                location.reload();
            },
            error: function (response) {
                alert('Error al agregar el producto: ' + response.responseJSON.message);
            }
        });
    });

    // CARGAR DATOS EN MODAL EDITAR
    $(document).on('click', '.editar', function () {
        let id = $(this).data('id');
        $.get(`/productos/${id}`, function (data) {
            $('#editId').val(data.id_producto);
            $('#editNombre').val(data.nombre);
            $('#editDescripcion').val(data.descripcion);
            $('#editPrecio').val(data.precio);
            $('#editStock').val(data.stock);
            $('#editCategoria').val(data.id_categoria);
            $('#editProveedor').val(data.id_proveedor);
        });
    });

    // EDITAR PRODUCTO
    $('#formEditar').submit(function (e) {
        e.preventDefault();
        let id = $('#editId').val();
        let formData = new FormData(this); // Crear un FormData para enviar archivos

        $.ajax({
            url: `/productos/update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-HTTP-Method-Override': 'PUT' // Sobrescribir el método para PUT
            },
            success: function (data) {
                location.reload();
            },
            error: function (response) {
                alert('Error al actualizar el producto: ' + response.responseJSON.message);
            }
        });
    });

    // ELIMINAR PRODUCTO
    $(document).on('click', '.eliminar', function () {
        let id = $(this).data('id');
        $('#formEliminar').attr('action', `/productos/delete/${id}`);
    });

    $('#formEliminar').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-HTTP-Method-Override': 'DELETE' // Sobrescribir el método para DELETE
            },
            success: function () {
                location.reload();
            },
            error: function (response) {
                alert('Error al eliminar el producto: ' + response.responseJSON.message);
            }
        });
    });
});
</script>

@endsection