// resources/js/components/adminCreateUserForm.js

export default function adminCreateUserForm(initialProps) {
    return {
        // --- Estado del Formulario (Simplificado) ---
        nombre: initialProps.oldNombre || '',
        p_apellido: initialProps.oldPApellido || '',
        s_apellido: initialProps.oldSApellido || '', // Opcional
        boleta: initialProps.oldBoleta || '',
        email: initialProps.oldEmail || '',
        idUnidadAcademica: initialProps.oldIdUnidadAcademica || '',
        idRolAdmin: initialProps.oldIdRolAdmin || '', // Opcional

        // --- Estado Validación Async ---
        boletaExists: null,
        emailExists: null,
        boletaChecking: false,
        emailChecking: false,
        boletaErrorMessage: '',
        emailErrorMessage: '',

        // --- Estado Contraseña ---
        generatedPassword: initialProps.initialPassword || '',

        // --- Props ---
        csrfToken: initialProps.csrfToken || '',
        checkFieldRoute: initialProps.checkFieldRoute || '', // Debería ser route('auth.checkField') o route('auth.checkField.admin')

        // --- Método de Validación General (Actualizado) ---
        isFormValid() {
            const isBoletaValid = this.boleta.trim() !== '' &&
                                  this.boletaExists === false &&
                                  !this.boletaErrorMessage.includes('inválido') &&
                                  !this.boletaChecking;

            const isEmailValid = this.email.trim() !== '' &&
                                 this.emailExists === false &&
                                 !this.emailErrorMessage.includes('inválido') &&
                                 !this.emailChecking;

            // Verifica que los campos requeridos (que quedan) no estén vacíos
            const requiredFieldsFilled = this.nombre.trim() !== '' &&
                                         this.p_apellido.trim() !== '' &&
                                         this.idUnidadAcademica !== '';

            // El botón está habilitado si todos los campos requeridos están llenos
            // Y si las validaciones asíncronas son correctas
            return requiredFieldsFilled && isBoletaValid && isEmailValid;
        },

        // --- Métodos Contraseña ---
        generatePassword(length = 16) {
            const chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%^&*()_+~`-=';
            let password = '';
            for (let i = 0; i < length; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            this.generatedPassword = password;
        },
        copyPassword() {
             const passwordField = document.getElementById('generated_password_display');
             if (!passwordField || !this.generatedPassword) return;

             navigator.clipboard.writeText(this.generatedPassword).then(() => {
                 // Considera una notificación más sutil (ej. usando una librería o un mensaje temporal)
                 alert('Contraseña copiada al portapapeles!');
             }).catch(err => {
                 console.error('Error al copiar la contraseña: ', err);
                 alert('No se pudo copiar la contraseña automáticamente. Por favor, cópiela manualmente.');
             });
        },

        // --- Métodos Validación Async ---
        handleBoletaInput() {
             this.boleta = this.boleta.trim();
             this.boletaErrorMessage = ''; this.boletaExists = null;
             if (this.boleta.length === 0) { this.boletaChecking = false; return; }
             // Validación de formato (10 dígitos)
             if (this.boleta.length !== 10 || !/^\d{10}$/.test(this.boleta)) {
                 this.boletaErrorMessage = 'Formato inválido (10 dígitos).';
                 this.boletaChecking = false; return;
             }
             // Si el formato es correcto, verifica existencia
             this.checkBoleta();
        },
        async checkBoleta() {
             if (this.boletaChecking) return;
             this.boletaChecking = true; this.boletaErrorMessage = ''; this.boletaExists = null;

             try {
                 // *** FETCH COMPLETO PARA BOLETA ***
                 const response = await fetch(this.checkFieldRoute, {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': this.csrfToken,
                         'Accept': 'application/json',
                     },
                     body: JSON.stringify({
                         field: 'boleta',
                         value: this.boleta,
                         context: 'admin' // <-- Envía el contexto (si usas Opción B)
                     })
                 });

                 if (!response.ok) {
                     let errorData = { message: `Error servidor (${response.status})` };
                     try { errorData = await response.json(); } catch (e) {}
                     // Si es 405, el mensaje podría ser más específico
                     if (response.status === 405) errorData.message = 'Método no permitido por el servidor.';
                     throw new Error(errorData.message || `Error ${response.status}`);
                 }

                 const data = await response.json();
                 // Manejo de posible error de validación devuelto por el backend (ej. formato)
                 if (response.status === 422 && data.message) {
                    this.boletaErrorMessage = data.message;
                    this.boletaExists = null;
                 } else {
                    this.boletaExists = data.exists;
                    this.boletaErrorMessage = data.exists ? 'Esta boleta ya está registrada.' : '';
                 }

             } catch (error) {
                 console.error('Error checkBoleta:', error);
                 this.boletaErrorMessage = error.message.includes('fetch') ? 'Error de red.' : (error.message || 'No se pudo verificar.');
                 this.boletaExists = null; // No se pudo verificar
             } finally {
                 this.boletaChecking = false;
             }
        },
        async checkEmail() {
             this.email = this.email.trim();
             this.emailErrorMessage = ''; this.emailExists = null;
             if (!this.email) { this.emailChecking = false; return; }

             // Validación de formato frontend (solo @ipn.mx para admin)
             if (!/^[^\s@]+@(ipn\.mx)$/i.test(this.email)) { // Usamos 'i' para case-insensitive
                 this.emailErrorMessage = 'El correo debe ser @ipn.mx';
                 this.emailChecking = false; return;
             }

             if (this.emailChecking) return;
             this.emailChecking = true; this.emailErrorMessage = ''; this.emailExists = null;

             try {
                 // *** FETCH COMPLETO PARA EMAIL ***
                 const response = await fetch(this.checkFieldRoute, {
                     method: 'POST',
                     headers: {
                         'Content-Type': 'application/json',
                         'X-CSRF-TOKEN': this.csrfToken,
                         'Accept': 'application/json',
                     },
                     body: JSON.stringify({
                         field: 'email',
                         value: this.email,
                         context: 'admin' // <-- Envía el contexto (si usas Opción B)
                     })
                 });

                 if (!response.ok) {
                    let errorData = { message: `Error servidor (${response.status})` };
                     try { errorData = await response.json(); } catch (e) {}
                     if (response.status === 405) errorData.message = 'Método no permitido por el servidor.';
                     throw new Error(errorData.message || `Error ${response.status}`);
                 }

                 const data = await response.json();
                 // Manejo de posible error de validación devuelto por el backend
                 if (response.status === 422 && data.message) {
                    this.emailErrorMessage = data.message;
                    this.emailExists = null;
                 } else {
                    this.emailExists = data.exists;
                    this.emailErrorMessage = data.exists ? 'Este correo ya está registrado.' : '';
                 }

             } catch (error) {
                 console.error('Error checkEmail:', error);
                 this.emailErrorMessage = error.message.includes('fetch') ? 'Error de red.' : (error.message || 'No se pudo verificar.');
                 this.emailExists = null; // No se pudo verificar
             } finally {
                 this.emailChecking = false;
             }
        },
    }
}
