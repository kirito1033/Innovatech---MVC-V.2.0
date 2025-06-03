<form id="my-form" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id" name="id" value=null>
    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value=null>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nombre del Producto">
        <label for="nom">Nombre del Producto</label>
    </div>

    <div class="form-floating mb-3">
        <input class="form-control" id="descripcion" name="descripcion" placeholder="Descripción"></input>
        <label for="descripcion">Descripción</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="existencias" name="existencias" placeholder="Existencias">
        <label for="existencias">Existencias</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
        <label for="precio">Precio</label>
    </div>


    <div class="form-floating mb-3">
        <input class="form-control" id="caracteristicas" name="caracteristicas" placeholder="Características"></input>
        <label for="caracteristicas">Características</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="tam" name="tam" placeholder="Tamaño">
        <label for="tam">Tamaño</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="tampantalla" name="tampantalla" placeholder="Tamaño de Pantalla">
        <label for="tampantalla">Tamaño de Pantalla</label>
    </div>
    
    <!-- Llaves foráneas con selects dinámicos -->
    <div class="form-floating mb-3">
        <select class="form-select" id="id_marca" name="id_marca">
            <option value="">Seleccione una Marca</option>
            <?php foreach ($marcas as $marca) : ?>
                <option value="<?= $marca['id']; ?>"><?= $marca['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="id_marca">Marca</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="id_estado" name="id_estado">
            <option value="">Seleccione un Estado</option>
            <?php foreach ($estado_productos as $estado) : ?>
                <option value="<?= $estado['id']; ?>"><?= $estado['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="id_estado">Estado</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="id_color" name="id_color">
            <option value="">Seleccione un Color</option>
            <?php foreach ($colores as $color) : ?>
                <option value="<?= $color['id_color']; ?>"><?= $color['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="id_color">Color</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="id_categoria" name="id_categoria">
            <option value="">Seleccione una Categoría</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria['id']; ?>"><?= $categoria['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="id_categoria">Categoría</label>
    </div>

    <div class="form-floating mb-3">
    <select class="form-select" id="id_garantia" name="id_garantia">
        <option value="">Seleccione una Garantía</option>
        <?php foreach ($garantias as $garantia) : ?>
            <option value="<?= $garantia['id']; ?>">
                <?= $garantia['numero_mes_año'] . "  " . $garantia['mes_año']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="id_garantia">Garantía</label>
</div>


<div class="form-floating mb-3">
    <select class="form-select" id="id_almacenamiento" name="id_almacenamiento">
        <option value="">Seleccione un Tipo de Almacenamiento</option>
        <?php foreach ($almacenamiento as $almac) : ?>
            <option value="<?= $almac['id']; ?>">
                <?= $almac['num'] . " " . $almac['unidadestandar']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="id_almacenamiento">Almacenamiento</label>
</div>


<div class="form-floating mb-3">
    <select class="form-select" id="id_ram" name="id_ram">
        <option value="">Seleccione la RAM</option>
        <?php foreach ($almacenamiento_aleatorio as $ram) : ?>
            <option value="<?= $ram['id']; ?>">
                <?= $ram['num'] . " " . $ram['unidadestandar']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="id_ram">Memoria RAM</label>
</div>


    <div class="form-floating mb-3">
        <select class="form-select" id="id_sistema_operativo" name="id_sistema_operativo">
            <option value="">Seleccione un Sistema Operativo</option>
            <?php foreach ($sistemas_operativos as $sistema) : ?>
                <option value="<?= $sistema['id']; ?>"><?= $sistema['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="id_sistema_operativo">Sistema Operativo</label>
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" id="id_resolucion" name="id_resolucion">
            <option value="">Seleccione una Resolución</option>
            <?php foreach ($resoluciones as $res) : ?>
                <option value="<?= $res['id']; ?>"><?= $res['nom']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="id_resolucion">Resolución</label>
    </div>
</form>
