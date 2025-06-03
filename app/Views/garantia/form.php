<form id="my-form">
    <input type="hidden" class="form-control" id="id" name="id" value="">
    <input type="hidden" class="form-control" id="update_at" name="update_at" value="">
    
    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numero_mes_año" name="numero_mes_año" placeholder="Cantidad de meses o años" min="1">
        <label for="numero_mes_año">Cantidad de meses o años</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="mes_año" name="mes_año" required>
            <option value="" selected disabled>Seleccione una opción</option>
            <option value="Mes">Mes</option>
            <option value="Año">Año</option>
        </select>
        <label for="mes_año">Seleccione Mes o Año</label>
    </div>
</form>
