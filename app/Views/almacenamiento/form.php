<!-- Formulario para registrar o editar una unidad de almacenamiento -->
<form id="my-form">

<!-- Campo oculto para el ID del registro (se usa en edición) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>

     <!-- Campo oculto para la fecha de actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
   <!-- Campo numérico: permite ingresar el valor numérico de la capacidad -->
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="num" name="num" placeholder="Numero">
        <label for="num">Numero</label>
    </div>

    <!-- Campo tipo select: permite seleccionar la unidad de medida (MB o GB) -->
    <div class="form-floating mb-3">
    <select class="form-select" id="unidadestandar" name="unidadestandar" required>
        <option value="" selected disabled>Seleccione una unidad</option>
        <option value="MB">MB</option>
        <option value="GB">GB</option>
    </select>
    <label for="unidadestandar">Unidad Estándar</label>
</div>

</form>