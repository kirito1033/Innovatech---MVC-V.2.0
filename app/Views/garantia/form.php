<!-- Formulario con ID para identificación en JS -->
<form id="my-form">

    <!-- Campo oculto para almacenar el ID del recurso que se está editando -->
    <input type="hidden" class="form-control" id="id" name="id" value="">
    <!-- Campo oculto para guardar la fecha de actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="">
    
    <!-- Campo numérico flotante para ingresar la cantidad -->
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numero_mes_año" name="numero_mes_año" placeholder="Cantidad de meses o años" min="1">
        <!-- Etiqueta flotante -->
        <label for="numero_mes_año">Cantidad de meses o años</label>
    </div>

    <!-- Selector flotante para elegir entre Mes o Año -->
    <div class="form-floating mb-3">
        <select class="form-select" id="mes_año" name="mes_año" required>
            <!-- Opción por defecto deshabilitada -->
            <option value="" selected disabled>Seleccione una opción</option>
           <!-- Opción: Mes -->
            <option value="Mes">Mes</option>
            <!-- Opción: Año -->
            <option value="Año">Año</option>
        </select>
        <!-- Etiqueta flotante del select -->
        <label for="mes_año">Seleccione Mes o Año</label>
    </div>
</form>
