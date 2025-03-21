@extends('layouts.admin')

@section('title', 'Proveedores')

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
    <h1 class="text-center">Proveedores</h1>

    <!-- Botón para abrir modal de agregar proveedor y buscador -->
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="buscador" class="form-control w-25 me-auto" placeholder="Buscar proveedor...">
        <button class="btn btn-success btn-pulse" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Proveedor</button>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center table-hover">
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaProveedores">
                @foreach ($proveedores as $proveedor)
                <tr id="proveedor_{{ $proveedor->id_proveedor }}">
                    <td>{{ $proveedor->id_proveedor }}</td>
                    <td>{{ $proveedor->nombre_proveedor }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->correo }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editar" data-id="{{ $proveedor->id_proveedor }}" data-bs-toggle="modal" data-bs-target="#modalEditar"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger btn-sm eliminar" data-id="{{ $proveedor->id_proveedor }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PARA AGREGAR PROVEEDOR -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregar">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" name="nombre_proveedor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDITAR PROVEEDOR -->
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEditar">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id_proveedor">
                    <div class="mb-3">
                        <label class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="editNombre" name="nombre_proveedor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="editTelefono" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" id="editCorreo" name="correo">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA ELIMINAR PROVEEDOR -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este proveedor?
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
        $('#tablaProveedores tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });

    // AGREGAR PROVEEDOR
    $('#formAgregar').submit(function (e) {
        e.preventDefault();
        
        // Deshabilitar el botón de guardar
        $('#formAgregar button[type="submit"]').prop('disabled', true);

        $.post("{{ route('proveedor.store') }}", $(this).serialize(), function (data) {
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
            
            alert('Error al agregar el proveedor: ' + response.responseJSON.message);
        });
    });

    // CARGAR DATOS EN MODAL EDITAR
    $(document).on('click', '.editar', function () {
        let id = $(this).data('id');
        $.get(`/proveedores/${id}`, function (data) {
            $('#editId').val(data.id_proveedor);
            $('#editNombre').val(data.nombre_proveedor);
            $('#editTelefono').val(data.telefono);
            $('#editCorreo').val(data.correo);
        });
    });

    // EDITAR PROVEEDOR
    $('#formEditar').submit(function (e) {
        e.preventDefault();
        let id = $('#editId').val();
        $.ajax({
            url: `/proveedores/update/${id}`,
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
                alert('Error al actualizar el proveedor: ' + response.responseJSON.message);
            }
        });
    });

    // ELIMINAR PROVEEDOR
    $(document).on('click', '.eliminar', function () {
        let id = $(this).data('id');
        $('#formEliminar').attr('action', `/proveedores/delete/${id}`);
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
                alert('Error al eliminar el proveedor: ' + response.responseJSON.message);
            }
        });
    });
});
</script>

@endsection