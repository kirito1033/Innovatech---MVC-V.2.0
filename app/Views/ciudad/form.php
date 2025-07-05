<!-- Formulario principal para registrar o editar una ciudad -->
<form id="my-form">

<!-- Campo oculto para el ID de la ciudad (solo se usa al editar un registro existente) -->
    <input type="hidden" class="form-control" id="id" name="id" value=null>
   
    <!-- Campo oculto para almacenar la fecha de actualización -->
    <input type="hidden" class="form-control" id="update_at" name="update_at" value=null>
    
    <!-- Campo para ingresar el código de la ciudad -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="code" name="code" placeholder="Codigó">
        <label for="code">Codigó</label>
    </div>

    <!-- Campo para ingresar el nombre de la ciudad -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        <label for="name">Nombre</label>
    </div>

      <!-- Campo para ingresar el departamento al que pertenece la ciudad -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="department" name="department" placeholder="Departamento">
        <label for="department">Departamento</label>
    </div>
    

</form>