export default function adminCatalogForm(initialProps) {
    return {
        autores: initialProps.autores || [],
        esDigital: initialProps.esDigital || false,
        nuevoAutor: '',
        addAutor() {
            if (this.nuevoAutor.trim() !== '') {
                this.autores.push(this.nuevoAutor.trim());
                this.nuevoAutor = '';
                this.updateHiddenField();
            }
        },
        removeAutor(index) {
            this.autores.splice(index, 1);
            this.updateHiddenField();
        },
        updateHiddenField() {
            const field = document.getElementById('autores_secundarios');
            if (field) field.value = this.autores.join(';');
        },
        init() {
            this.updateHiddenField();
        }
    };
}