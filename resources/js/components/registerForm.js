// resources/js/components/registerForm.js

// Asegúrate que Alpine esté disponible globalmente o impórtalo si usas módulos
// import Alpine from 'alpinejs';

export default function registerForm(initialProps) {
  return {
    // --- Estado del Componente ---
    step: 1,
    maxStep: 3,
    // Modelos inicializados desde initialProps (con fallback a '')
    nombre: initialProps.oldNombre || '',
    p_apellido: initialProps.oldPApellido || '',
    s_apellido: initialProps.oldSApellido || '',
    boleta: initialProps.oldBoleta || '',
    categoriaUsuario: initialProps.oldCategoriaUsuario || '',
    idUnidadAcademica: initialProps.oldIdUnidadAcademica || '',
    email: initialProps.oldEmail || '',
    password: '', // No pre-rellenar contraseñas
    password_confirmation: '',

    // Estados para validación asíncrona
    boletaExists: null, // null: no verificado, true: existe, false: no existe
    emailExists: null,  // null: no verificado, true: existe, false: no existe
    boletaChecking: false,
    emailChecking: false,
    boletaErrorMessage: '',
    emailErrorMessage: '',

    // Props pasados desde Blade
    csrfToken: initialProps.csrfToken || '',
    checkFieldRoute: initialProps.checkFieldRoute || '',

    // --- Métodos del Componente ---

    // Verifica si el paso actual es válido (incluye checks async y de contraseña)
    isStepValid() {
      if (this.step === 1) {
        // Nombre y Primer Apellido son obligatorios
        return this.nombre.trim() !== '' && this.p_apellido.trim() !== '';
      }
      if (this.step === 2) {
        // Campos obligatorios y la boleta debe ser válida y no existir
        return this.boleta.trim() !== '' &&
               this.categoriaUsuario !== '' &&
               this.idUnidadAcademica !== '' &&
               this.boletaExists === false; // Solo válido si se verificó y no existe
      }
      if (this.step === 3) {
        // Campos obligatorios, contraseñas coinciden y email válido y no existe
        return this.email.trim() !== '' && /^\S+@\S+\.\S+$/.test(this.email) && // Formato email
               this.password !== '' &&
               this.password_confirmation !== '' &&
               this.password === this.password_confirmation && // Contraseñas coinciden
               this.emailExists === false; // Solo válido si se verificó y no existe
      }
      return false; // Por defecto
    },

    // Manejador para input de boleta con chequeo de longitud y formato
    handleBoletaInput() {
        this.boleta = this.boleta.trim();
        // Limpiar estado si la longitud es menor a 9
        if (this.boleta.length < 9) {
            this.boletaExists = null;
            this.boletaErrorMessage = this.boleta.length > 0 ? 'La boleta debe tener 10 dígitos.' : '';
            this.boletaChecking = false;
            return; // No verificar aún
        }

        // Validar formato numérico 10 dígitos
        if (!/^\d{10}$/.test(this.boleta)) {
            this.boletaErrorMessage = 'Formato inválido (8-10 dígitos).';
            this.boletaExists = null;
            this.boletaChecking = false;
            return; // Formato inválido
        }

        // Si formato y longitud son correctos, proceder a verificar con el backend
        this.checkBoleta();
    },

    // Verifica la boleta (asíncrono)
    async checkBoleta() {
      // Evitar llamadas si ya se está verificando
      if (this.boletaChecking) return;

      this.boletaChecking = true;
      this.boletaErrorMessage = ''; // Limpiar mensaje previo
      this.boletaExists = null;

      try {
        const response = await fetch(this.checkFieldRoute, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': this.csrfToken,
            'Accept': 'application/json',
          },
          body: JSON.stringify({ field: 'boleta', value: this.boleta })
        });

        if (!response.ok) {
            let errorData = { message: `Error ${response.status}` };
            try { errorData = await response.json(); } catch (e) {}
            throw new Error(errorData.message || `Error ${response.status}`);
        }

        const data = await response.json();
        this.boletaExists = data.exists;
        this.boletaErrorMessage = data.exists ? 'Esta boleta ya está registrada.' : '';

      } catch (error) {
        console.error('Error boleta:', error);
        this.boletaErrorMessage = error.message.includes('Failed to fetch') ? 'Error de red al verificar.' : (error.message || 'No se pudo verificar.');
        this.boletaExists = null; // Considerar no válido si hay error
      } finally {
        this.boletaChecking = false;
      }
    },

    // Verifica el email (asíncrono)
    async checkEmail() {
        this.email = this.email.trim();
        // Validar formato antes de enviar
        if (
          !this.email ||
          !/^[^\s@]+@(alumno\.ipn\.mx|ipn\.mx)$/.test(this.email)
        ) {
          this.emailExists = null;
          this.emailErrorMessage = !this.email
            ? ''
            : 'El correo debe ser @alumno.ipn.mx o @ipn.mx';
          this.emailChecking = false;
          return;
        }
        
        // Evitar llamadas si ya se está verificando
        if (this.emailChecking) return;

        this.emailChecking = true;
        this.emailErrorMessage = ''; // Limpiar mensaje previo
        this.emailExists = null;

        try {
            const response = await fetch(this.checkFieldRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    field: 'email',
                    value: this.email
                })
            });

             if (!response.ok) {
                let errorData = { message: `Error ${response.status}` };
                try { errorData = await response.json(); } catch (e) {}
                throw new Error(errorData.message || `Error ${response.status}`);
             }

            const data = await response.json();
            this.emailExists = data.exists;
            this.emailErrorMessage = data.exists ? 'Este correo ya está registrado.' : '';

        } catch (error) {
             console.error('Error email:', error);
             this.emailErrorMessage = error.message.includes('Failed to fetch') ? 'Error de red al verificar.' : (error.message || 'No se pudo verificar.');
             this.emailExists = null; // Considerar no válido si hay error
        } finally {
             this.emailChecking = false;
        }
    },

    // Maneja el envío del formulario
    handleSubmit(event) {
        // Doble chequeo por si acaso, aunque el botón debería estar deshabilitado
        if (!this.isStepValid() && this.step === this.maxStep) {
            event.preventDefault();
            console.warn('Intento de envío bloqueado: El último paso no es válido.');
            // Podrías forzar la visualización de errores aquí si fuera necesario
        }
        // Si es válido, el formulario se envía normalmente
    }

  }; // Fin del objeto retornado
} // Fin de la función registerForm
