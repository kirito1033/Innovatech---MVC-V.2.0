<!-- Formulario para crear o editar un registro de almacenamiento aleatorio (por ejemplo, RAM) -->
<form id="my-form">

<!-- Campo oculto que guarda el ID del registro (utilizado en actualizaciones) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    
    <!-- Campo oculto que almacena la fecha de actualización (puede ser asignado por backend) -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Campo numérico: representa el valor de capacidad (ej: 8, 16, 32) -->
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="num" name="num" placeholder="Numero">
        <label for="num">Numero</label>
    </div>

    <!-- Selector de unidad estándar de medida (obligatorio) -->
    <div class="form-floating mb-3">
    <select class="form-select" id="unidadestandar" name="unidadestandar" required>
        <!-- Opción por defecto -->
        <option value="" selected disabled>Seleccione una unidad</option>

        <!-- Unidades permitidas -->
        <option value="MB">MB</option>
        <option value="GB">GB</option>
    </select>
    <label for="unidadestandar">Unidad Estándar</label>
</div>

</form>