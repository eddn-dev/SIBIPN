<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Asegúrate que el nombre de la clase coincida con el nombre del archivo de migración
// Ejemplo: CreatePermissionRoleTable
return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla pivote para la relación muchos-a-muchos entre roles y permisos.
     */
    public function up(): void
    {
        Schema::create('permission_role', function (Blueprint $table) {
            // Claves foráneas unsignedBigInteger para coincidir con los 'id' de las tablas referenciadas
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id'); // Nombre de columna consistente con FK a rol_admin

            // Definición de las claves foráneas
            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions') // Referencia a la tabla 'permissions'
                  ->onDelete('cascade'); // Si se elimina un permiso, se elimina la relación

            $table->foreign('role_id')
                  ->references('id')
                  ->on('rol_admin') // Referencia a la tabla 'rol_admin'
                  ->onDelete('cascade'); // Si se elimina un rol, se elimina la relación

            // Clave primaria compuesta para asegurar que cada par permiso-rol sea único
            $table->primary(['permission_id', 'role_id']);

            // No se necesitan timestamps para esta tabla pivote típicamente
            // $table->timestamps(); // Puedes descomentar si necesitas rastrear cuándo se creó la relación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
