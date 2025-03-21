@extends('layouts.admin')

@section('title', 'Categorías')

@section('content')
<style>
    #buscador {
        max-width: 250px;
    }

    /* Animaciones adicionales */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .btn-pulse {
        animation: pulse 2s infinite;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
        transition: background-color 0.3s ease;
    }
</style>

<div class="container mt-4">
    <h1 class="text-center">Categorías</h1>

    <!-- Botón para abrir modal de agregar categoría y buscador -->
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscador" class="form-control w-25 me-auto" placeholder="Buscar categoría...">
        <button class="btn btn-success btn-pulse" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Categoría</button>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center table-hover">
            <thead>
                <tr>
                    <th>ID Categoría</th>
                    <th>Nombre Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaCategorias">
                @foreach ($categorias as $categoria)
                <tr id="categoria_{{ $categoria->id_categoria }}">
                    <td>{{ $categoria->id_categoria }}</td>
                    <td>{{ $categoria->nombre_categoria }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editar" data-id="{{ $categoria->id_categoria }}" data-bs-toggle="modal" data-bs-target="#modalEditar"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="{{ $categoria->id_categoria }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PARA AGREGAR CATEGORÍA -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregar">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" name="nombre_categoria" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDITAR CATEGORÍA -->
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditar">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id_categoria">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre_categoria" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA ELIMINAR CATEGORÍA -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta categoría?
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
        let valor = $(this).val().toLowerCase(); // Obtener el valor del buscador en minúsculas

        // Filtrar las filas de la tabla
        $('#tablaCategorias tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });

    // AGREGAR CATEGORÍA
    $('#formAgregar').submit(function (e) {
        e.preventDefault();
        
        // Deshabilitar el botón de guardar
        $('#formAgregar button[type="submit"]').prop('disabled', true);

        $.post("{{ route('categoria.store') }}", $(this).serialize(), function (data) {
            // Cerrar el modal manualmente
            var modalAgregar = bootstrap.Modal.getInstance(document.getElementById('modalAgregar'));
            modalAgregar.hide();

            // Limpiar el formulario
            $('#formAgregar')[0].reset();

            // Recargar la página para reflejar los cambios
            location.reload();
        }).fail(function (response) {
            // Habilitar el botón de guardar en caso de error
            $('#formAgregar button[type="submit"]').prop('disabled', false);
            
            alert('Error al agregar la categoría: ' + response.responseJSON.message);
        });
    });

    // CARGAR DATOS EN MODAL EDITAR
    $(document).on('click', '.editar', function () {
        let id = $(this).data('id');
        $.get(`/categorias/${id}`, function (data) {
            $('#editId').val(data.id_categoria);
            $('#editNombre').val(data.nombre_categoria);
        });
    });

    // EDITAR CATEGORÍA
    $('#formEditar').submit(function (e) {
        e.preventDefault();
        let id = $('#editId').val();
        $.ajax({
            url: `/categorias/update/${id}`,
            type: 'PUT',
            data: $(this).serialize(),
            success: function (data) {
                // Cerrar el modal manualmente
                var modalEditar = bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
                modalEditar.hide();

                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function (response) {
                alert('Error al actualizar la categoría: ' + response.responseJSON.message);
            }
        });
    });

    // ELIMINAR CATEGORÍA
    $(document).on('click', '.eliminar', function () {
        let id = $(this).data('id');
        $('#formEliminar').attr('action', `/categorias/delete/${id}`);
    });

    $('#formEliminar').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: $(this).serialize(),
            success: function () {
                // Cerrar el modal manualmente
                var modalEliminar = bootstrap.Modal.getInstance(document.getElementById('modalEliminar'));
                modalEliminar.hide();

                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function (response) {
                alert('Error al eliminar la categoría: ' + response.responseJSON.message);
            }
        });
    });
});
</script>

@endsection