<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_items', function (Blueprint $table) {
            $table->uuid('idDigital')->primary()->comment('PK UUID del archivo digital');
            $table->uuid('idRegistroBibliografico');
            $table->string('archivo_path');
            $table->string('mime_type', 100)->nullable();
            $table->boolean('es_publico')->default(true);
            $table->timestamps();

            $table->foreign('idRegistroBibliografico')
                  ->references('idRegistro')->on('registros_bibliograficos')
                  ->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_items');
    }
};