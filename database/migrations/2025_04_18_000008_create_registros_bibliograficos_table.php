<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registros_bibliograficos', function (Blueprint $table) {
            $table->uuid('idRegistro')->primary()->comment('PK UUID para el registro bibliográfico.');
            $table->string('titulo');
            $table->string('autor_principal')->nullable();
            // Podrías tener tablas separadas para autores, temas, editoriales y relacionarlas (más normalizado)
            // pero para empezar, campos de texto pueden servir.
            $table->string('autores_secundarios')->nullable();
            $table->string('editorial')->nullable();
            $table->year('anio_publicacion')->nullable();
            $table->string('lugar_publicacion')->nullable();
            $table->string('edicion', 100)->nullable();
            $table->string('isbn', 20)->nullable()->index();
            $table->string('issn', 20)->nullable()->index();
            $table->enum('tipo_material', ['Libro', 'Tesis', 'Revista', 'Articulo', 'Audiovisual', 'RecursoElectronico', 'Otro'])->index();
            $table->text('resumen')->nullable();
            $table->string('idioma', 50)->nullable();
            $table->string('temas_palabras_clave')->nullable()->comment('Separados por ; o similar, o normalizar en tabla aparte');
            $table->string('portada_url')->nullable();
            // Para MARC: O un campo TEXT/LONGTEXT para el MARC crudo, o campos específicos + JSON para detalles
            $table->json('datos_marc')->nullable()->comment('Almacena campos MARC específicos o toda la estructura');
            $table->boolean('es_digital')->default(false)->comment('Indica si es principalmente un recurso digital');
            $table->timestamps(); // created_at, updated_at

            // Índices para búsquedas comunes
            $table->index('titulo');
            $table->index('autor_principal');
            $table->index('anio_publicacion');
            // Considera FULLTEXT index para titulo, autor, resumen, temas si usas MySQL/MariaDB y necesitas búsqueda de texto completo
            //$table->fullText(['titulo', 'autor_principal', 'resumen', 'temas_palabras_clave']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_bibliograficos');
    }
};
