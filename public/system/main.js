class Main {
	constructor(modalId, formId, classEdit, preloadId) {
		this.myModal = new bootstrap.Modal(document.getElementById(modalId));
		this.myForm = document.getElementById(formId);
		this.classEdit = classEdit;
		this.elementJson = {};
		this.formData = new FormData();
		this.preload = document.getElementById(preloadId);
	}

	showPreload() {
		 this.preload.classList.remove('d-none');
	}

	hiddenPreload() {
		this.preload.classList.add('d-none');
	}

	showModal() {
		this.myModal.show();
	}

	hiddenModal() {
		this.myModal.hide();
	}

	getForm() {
		return this.myForm;
	}

	disabledFormAll() {
		var elementsInput = this.myForm.querySelectorAll("input");
		var elementsSelect = this.myForm.querySelectorAll("select");
		for (let i = 0; i < elementsInput.length; i++) {
			elementsInput[i].disabled = true;
		}
		for (let j = 0; j < elementsSelect.length; j++) {
			elementsSelect[j].disabled = true;
		}
	}

	disabledFormEdit() {
		var elementsInput = this.myForm.querySelectorAll("input");
		var elementsSelect = this.myForm.querySelectorAll("select");
		for (let i = 0; i < elementsInput.length; i++) {
			if (elementsInput[i].classList.contains(this.classEdit)) {
				elementsInput[i].disabled = true;
			} else {
				elementsInput[i].disabled = false;
			}
		}
		for (let j = 0; j < elementsSelect.length; j++) {
			if (elementsSelect[j].classList.contains(this.classEdit)) {
				elementsSelect[j].disabled = true;
			} else {
				elementsSelect[j].disabled = false;
			}
		}
	}

	enableFormAll() {
		var elementsInput = this.myForm.querySelectorAll("input");
		var elementsSelect = this.myForm.querySelectorAll("select");
		for (let i = 0; i < elementsInput.length; i++) {
			elementsInput[i].disabled = false;
		}
		for (let j = 0; j < elementsSelect.length; j++) {
			elementsSelect[j].disabled = false;
		}
	}

	resetForm() {
		var elementsInput = this.myForm.querySelectorAll("input");
		var elementsSelect = this.myForm.querySelectorAll("select");
		for (let i = 0; i < elementsInput.length; i++) {
			elementsInput[i].value = "";
		}
		for (let j = 0; j < elementsSelect.length; j++) {
			elementsSelect[j].value = "";
		}
		this.myForm.reset();
	}		

	getDataFormJson() {
		var elementsForm = this.myForm.querySelectorAll('input, select');
		let getJson = {};
		elementsForm. forEach(function (element) {
			if (element.id) {
				if (element.tagName ==='INPUT') {
					if (element.type === 'checkbox') {
						getJson[element.id] = element.ariaChecked;
					} else {
						getJson[element.id] = element.value.trim();
					}
				} else if (element.tagName === 'SELECT') {
					getJson[element.id] = element.value.trim();
				}
			}
		});
		return getJson;
	}

	getDataFormData() {
		var elementsForm = this.myForm.querySelectorAll('input, select');
		elementsForm.forEach((element) => {
			if (element.id) {
				if (element.tagName === 'INPUT') {
					if (element.type === 'checkbox') {
						this.formData.append(element.id, element.checked);
					} else {
						this.formData.append(element.id, element.value.trim());
					}
				} else if (element.tagName === 'SELECT') {
					this.formData.append(element.id, element.value.trim());
				}
			}
		});
		return this.formData;
	}

	setDataFormJson(json) {
		let elements = this.myForm.querySelectorAll("input,select");
		for (let i = 0; i < elements.length; i++) {
			document.getElementById(elements[i].id).value = json[elements[i].id];
		}
	}

	setValidateForm() {
		const objForm = this.myForm;
		const inputs = objForm.querySelectorAll('input');
		const selects = objForm.querySelectorAll('select');
		let formValidate = true;
		for (const input of inputs) {
			if (!this.validateInput(input)) {
				formValidate = false;
				this.showMessageError(input);
			}
		}
		for (const select of selects) {
			if (select.value == 0) {
				formValidate = false;
				select.focus();
			}
		}
		if (formValidate) {
			this.hiddenMessageError();
			return true;
		} else {
			return false;
		}
	}

	/**
 * Valida un campo individual basado en sus atributos HTML y devuelve un mensaje de error si es inválido.
 * @param {HTMLInputElement} input - El campo del formulario a validar.
 * @returns {string|null} - Devuelve el mensaje de error como un string, o null si el campo es válido.
 */
validateInput(input) {
    const value = input.value.trim();
    const type = input.type;

    // 1. Valida si es requerido
    // Si el campo es requerido y está vacío, es un error.
    if (input.hasAttribute('required') && value === '') {
        return 'Este campo es obligatorio.';
    }

    // Si no es requerido y está vacío, no se valida nada más. Es válido.
    if (!input.hasAttribute('required') && value === '') {
        return null;
    }

    // 2. Valida la longitud mínima y máxima
    if (input.minLength > 0 && value.length < input.minLength) {
        return `Debe tener al menos ${input.minLength} caracteres.`;
    }
    if (input.maxLength > 0 && value.length > input.maxLength) {
        return `No debe exceder los ${input.maxLength} caracteres.`;
    }

    // 3. Valida por patrón (expresión regular)
    // Es muy útil para formatos personalizados (teléfonos, códigos postales, etc.)
    if (input.pattern) {
        const regex = new RegExp(input.pattern);
        if (!regex.test(value)) {
            // Usa el atributo 'title' del input para un mensaje de error personalizado
            return input.title || 'El formato no es válido.';
        }
    }

    // 4. Validaciones específicas por tipo de input
    switch (type) {
        case 'email':
            const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!emailRegex.test(value)) {
                return 'Por favor, introduce un email válido.';
            }
            break;
            
        case 'number':
            const numValue = parseFloat(value);
            if (isNaN(numValue)) {
                return 'Por favor, introduce un número válido.';
            }
            if (input.min !== '' && numValue < parseFloat(input.min)) {
                return `El valor mínimo es ${input.min}.`;
            }
            if (input.max !== '' && numValue > parseFloat(input.max)) {
                return `El valor máximo es ${input.max}.`;
            }
            break;

        case 'url':
            try {
                new URL(value); // Intenta crear un objeto URL; si falla, lanza un error.
            } catch (_) {
                return 'Por favor, introduce una URL válida.';
            }
            break;
        
        case 'password':
            // Puedes añadir aquí reglas más complejas si lo necesitas
            // (ej. requerir mayúsculas, números, etc.)
            // Por ahora, se controla con minlength.
            break;
    }

    // Si pasó todas las validaciones, el campo es válido.
    return null;
}

/**
 * Muestra un mensaje de error debajo de un campo.
 * Previene la duplicación de mensajes.
 * @param {HTMLElement} input - El campo que tiene el error.
 * @param {string} message - El mensaje de error específico a mostrar.
 */
showMessageError(input, message) {
    // Busca si ya existe un elemento de error para este input
    const errorContainerId = `error-for-${input.id || input.name}`;
    let errorContainer = document.getElementById(errorContainerId);

    // Añade la clase de error al input para estilizarlo (ej. borde rojo)
    input.classList.add('error');

    // Si no existe el contenedor de error, créalo
    if (!errorContainer) {
        errorContainer = document.createElement('span');
        errorContainer.id = errorContainerId;
        errorContainer.classList.add('message-error');
        // Inserta el mensaje de error después del input
        input.parentNode.insertBefore(errorContainer, input.nextSibling);
    }
    
    // Asigna el texto del mensaje
    errorContainer.textContent = message;
}

/**
 * Oculta y elimina el mensaje de error de un campo.
 * @param {HTMLElement} input
 */
hiddenMessageError(input) {
    const errorContainerId = `error-for-${input.id || input.name}`;
    const errorContainer = document.getElementById(errorContainerId);
    
    // Quita la clase de error del input
    input.classList.remove('error');

    // Si existe el contenedor de error, elimínalo del DOM
    if (errorContainer) {
        errorContainer.remove();
    }
}
}