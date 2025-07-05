<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <!-- Estilos y librerías externas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<!-- Encabezado con navbar -->
<header>
    <?= $this->include('partials/header') ?>
</header>
<!-- Contenedor principal del perfil -->
<div class="profile-container">
    <div class="profile-header">
        <h2>Perfil de Usuario</h2>
        <br>
        <!-- Imagen de perfil con botón para cambiarla -->
        <div class="profile-picture-wrapper mb-3">
            <img id="profileImage" src="/uploads/perfiles/profile.jpg" alt="Avatar" class="profile-avatar" />
            <button id="editProfileImageBtn" class="edit-image-btn" disabled
            onclick="showImageModal(<?php echo $usuario['id_usuario']; ?>)">
            <i class="bi bi-camera-fill"></i>
            </button>
            <input type="file" id="profileImageInput" accept="image/*" style="display: none"/>
        </div>
    </div>

    <!-- Formulario de información del perfil -->
    <form id="formPerfil">
        <input type="hidden" id="user-id" />
        <div class="row g-4 profile-info">
            <!-- Campos de datos personales -->
            <div class="col-md-6">
                <label for="name" class="form-label">Primer Nombre</label>
                <input type="text" id="firstname" class="form-control" disabled />
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Segundo Nombre</label>
                <input type="text" id="secondname" class="form-control" disabled />
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Primer Apellido</label>
                <input type="text" id="lastname1" class="form-control" disabled />
            </div>

            <div class="col-md-6">
                <label for="name" class="form-label">Segundo Apellido</label>
                <input type="text" id="lastname2" class="form-control" disabled />
            </div>
            
            <div class="col-md-6">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" id="username" class="form-control" disabled />
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" class="form-control" disabled />
            </div>

            <div class="col-md-6">
                <label for="type_document" class="form-label">Tipo de Documento</label>
                <input type="text" id="type_document" class="form-control" disabled />
            </div>

            <div class="col-md-6">
                <label for="document" class="form-label">Documento</label>
                <input type="number" id="document" class="form-control" disabled />
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Primer Teléfono</label>
                <input type="number" id="phone1" class="form-control" disabled />
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Segundo Teléfono</label>
                <input type="number" id="phone2" class="form-control" disabled />
            </div>

            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" class="form-control" disabled />
            </div>

            <div id="passwordChangeContainer" class="col-md-6">
                <label for="newPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="newPassword" placeholder="••••••••" disabled>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="edit-btn mt-4">
            <button type="button" class="btn btn-dark" id="editToggleBtn" onclick="toggleEditMode()">Editar Perfil</button>
            <button type="submit" class="btn btn-edit" id="saveProfileBtn" disabled>Guardar Cambios</button>
        </div>
    </form>
</div>

<!-- Modal para subir imagen de perfil -->
<div class="modal fade" id="modalImagenUsuario" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formImagenUsuario" enctype="multipart/form-data">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Imagen del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_usuario" id="UsuarioIdImagen">
                    <div class="mb-3">
                        <label for="imagen" class="text-dark">Selecciona una imagen</label>
                        <input class="form-control" type="file" name="foto_perfil" id="imagenInput" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir Imagen</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal para verificación de contraseña antes de editar -->
<div class="modal fade" id="verificarPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title">Verificar Contraseña</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div id="passwordError" class="alert alert-danger d-none"></div>
                <div class="mb-3">
                    <label for="verificarPassword" class="form-label">Ingresa tu contraseña</label>
                    <input type="password" class="form-control" id="verificarPassword" placeholder="••••••••">
                </div>
            </div>
            <div class="modal-footer">
                <button id="confirmarPasswordBtn" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Ejecutar cuando el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", () => {
        // Mostrar el spinner de carga
        const preload = document.getElementById("preload");
        preload.style.display = "flex";

        // Captura de referencias a todos los campos del formulario
        const userIdInput     = document.getElementById("user-id");
        const firstnameInput  = document.getElementById("firstname");
        const secondnameInput = document.getElementById("secondname");
        const lastname1Input  = document.getElementById("lastname1");
        const lastname2Input  = document.getElementById("lastname2");
        const usernameInput   = document.getElementById("username");
        const emailInput      = document.getElementById("email");
        const documentInput   = document.getElementById("document");
        const typedocumentInput   = document.getElementById("type_document");
        const phone1Input     = document.getElementById("phone1");
        const phone2Input     = document.getElementById("phone2");
        const direccionInput  = document.getElementById("direccion");
        const profileImage    = document.getElementById("profileImage");
        const newPasswordInput = document.getElementById("newPassword");

        const saveProfileBtn = document.getElementById("saveProfileBtn");
        const editToggleBtn = document.getElementById("editToggleBtn");
        const profileForm = document.getElementById("formPerfil");


        let isEditing = false; // Bandera para saber si se está en modo edición

        // Obtener datos del perfil desde el backend
        fetch(`${window.location.origin}/perfil/datos`)
            .then(res => {
                if (!res.ok) throw new Error("Error al obtener datos del perfil");
                return res.json();
            })
            .then(data => {
                // Asignar los valores recibidos a los inputs del formulario
                firstnameInput.value  = data.primer_nombre     || '';
                secondnameInput.value = data.segundo_nombre    || '';
                lastname1Input.value  = data.primer_apellido   || '';
                lastname2Input.value  = data.segundo_apellido  || '';
                usernameInput.value   = data.usuario           || '';
                emailInput.value      = data.correo            || '';
                documentInput.value   = data.documento         || '';
                typedocumentInput.value = data.nombre_tipo_documento || '';
                phone1Input.value     = data.telefono1         || '';
                phone2Input.value     = data.telefono2         || '';
                direccionInput.value  = data.direccion         || '';
                userIdInput.value     = data.id_usuario        || '';

                // Cargar imagen de perfil si existe, o imagen por defecto
                const imgPath = data.foto_perfil 
                    ? `/uploads/perfiles/${data.foto_perfil}`
                    : `/uploads/perfiles/profile.jpg`;
                profileImage.src = imgPath;
            })
            .catch(err => {
                console.error("Error cargando perfil:", err);
            })
            .finally(() => {
                preload.style.display = "none"; // Ocultar el spinner
            });

        // Función para activar o desactivar el modo de edición del perfil
        window.toggleEditMode = () => {
            if (!isEditing) {
                // Mostrar modal para verificar contraseña
                const modal = new bootstrap.Modal(document.getElementById('verificarPasswordModal'));
                modal.show();

                // Limpiar el campo de contraseña anterior y errores
                document.getElementById("verificarPassword").value = "";
                document.getElementById("passwordError").classList.add("d-none");

                // Acción al confirmar contraseña en el modal
                document.getElementById("confirmarPasswordBtn").onclick = async () => {
                    const password = document.getElementById("verificarPassword").value;

                    const res = await fetch(`${window.location.origin}/perfil/verificar-password`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({ password })
                    });

                    const data = await res.json();

                    if (res.ok && data.status === "success") {
                        modal.hide(); // Ocultar modal
                        isEditing = true; // Activar modo edición

                        // Habilitar campos del formulario
                        [
                            firstnameInput, secondnameInput, lastname1Input, lastname2Input,
                            usernameInput, emailInput, phone1Input, phone2Input, direccionInput
                        ].forEach(input => input.disabled = false);

                        // Habilitar botones
                        saveProfileBtn.disabled = false;
                        saveProfileBtn.classList.add("btn-save-active");

                        editToggleBtn.textContent = "Cancelar";
                        editToggleBtn.classList.add("btn-cancel");
                        editToggleBtn.classList.remove("btn-dark");

                        document.getElementById("editProfileImageBtn").disabled = false;

                        // Habilitar cambio de contraseña si existe
                        const passwordInput = document.getElementById("newPassword");
                        if (passwordInput) {
                            passwordInput.disabled = false;
                        }

                    } else {
                        // Mostrar error si la contraseña es incorrecta
                        document.getElementById("passwordError").innerText = data.message || "Contraseña incorrecta";
                        document.getElementById("passwordError").classList.remove("d-none");
                    }
                };

            } else {
                // Si ya estaba editando, cancelar edición
                isEditing = false;

                // Deshabilitar campos del formulario
                [
                    firstnameInput, secondnameInput, lastname1Input, lastname2Input,
                    usernameInput, emailInput, phone1Input, phone2Input, direccionInput
                ].forEach(input => input.disabled = true);

                saveProfileBtn.disabled = true;
                saveProfileBtn.classList.remove("btn-save-active");

                editToggleBtn.textContent = "Editar Perfil";
                editToggleBtn.classList.remove("btn-cancel");
                editToggleBtn.classList.add("btn-dark");

                document.getElementById("editProfileImageBtn").disabled = true;

                // Deshabilitar contraseña si existía
                const passwordInput = document.getElementById("newPassword");
                if (passwordInput) {
                    passwordInput.disabled = true;
                }
            }
        };


        // Enviar cambios del perfil al servidor al enviar el formulario
        profileForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            // Preparar los datos actualizados
            const updatedData = {
                primer_nombre:    firstnameInput.value,
                segundo_nombre:   secondnameInput.value,
                primer_apellido:  lastname1Input.value,
                segundo_apellido: lastname2Input.value,
                correo:           emailInput.value,
                telefono1:        phone1Input.value,
                telefono2:        phone2Input.value,
                direccion:        direccionInput.value,
                usuario:          usernameInput.value,
                password:         newPasswordInput?.value || null
            };

            try {
                const res = await fetch(`${window.location.origin}/perfil/actualizar`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(updatedData)
                });

                const result = await res.json();

                if (!res.ok) throw new Error(result.error || "Error al actualizar");

                alert(result.mensaje || "Perfil actualizado");
                toggleEditMode(); // Salir del modo edición
            } catch (err) {
                console.error("Error:", err.message);
            }
        });

        // Subida de nueva imagen de perfil
        document.getElementById("profileImageInput").addEventListener("change", async function () {
            const file = this.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append("imagen", file);

            try {
                const res = await fetch(`${window.location.origin}/perfil/actualizar-imagen`, {
                    method: "POST",
                    body: formData
                });

                const result = await res.json();
                if (res.ok && result.imagen) {
                    // Mostrar la nueva imagen
                    document.getElementById("profileImage").src = `/uploads/perfiles/${result.imagen}`;
                    alert("Imagen actualizada");
                } else {
                    alert("Error al subir imagen");
                }
            } catch (err) {
                console.error("Error al subir imagen:", err);
            }
        });
    });

    // Mostrar modal de cambio de imagen
    function showImageModal(id_usuario) {
        console.log(id_usuario);
        document.getElementById('UsuarioIdImagen').value = id_usuario;
        document.getElementById('imagenInput').value = "";
        const modal = new bootstrap.Modal(document.getElementById('modalImagenUsuario'));
        modal.show();
    }

    // Evento para enviar imagen desde el modal
    document.getElementById("formImagenUsuario").addEventListener("submit", function(e) {
        e.preventDefault();
        const form = document.getElementById("formImagenUsuario");
        const formData = new FormData(form);

        // Mostrar en consola los datos enviados (debug)
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }
        fetch("<?= base_url('/perfil/actualizar-imagen') ?>", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.message === "success") {
                alert("Imagen actualizada correctamente.");
                location.reload(); // Recargar para reflejar cambio
            } else {
                alert(data.message);
            }
        })
        .catch(err => {
            console.error("Error al subir imagen:", err);
        });
    });
</script>

<footer>
    <?php require_once("../app/Views/footer/footerApp.php") ?>
</footer>

<div id="preload" style="
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(255,255,255,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    display: none;">
    <div class="spinner" style="
        width: 60px;
        height: 60px;
        border: 6px solid #ccc;
        border-top: 6px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;">
    </div>
</div>

</body>
</html>