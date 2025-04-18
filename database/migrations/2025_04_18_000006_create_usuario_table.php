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
        Schema::create('usuarios', function (Blueprint $table) {
            // --- CAMBIO CLAVE: Usar UUID como PK ---
            $table->uuid('id')->primary()->comment('PK UUID para el usuario');
            // --- FIN CAMBIO CLAVE ---

            $table->string('nombreCompleto', 255)->comment('Nombre(s) y Apellidos del usuario.');
            $table->string('boleta', 10)->unique()->comment('Boleta o número de empleado del usuario.');
            $table->string('email', 255)->unique()->comment('Correo electrónico institucional.');
            $table->timestamp('email_verified_at')->nullable(); // Campo estándar para verificación
            $table->string('password', 255)->comment('Hash de la contraseña.'); // Campo estándar para hash

            // Tus campos personalizados
            $table->string('idUnidadAcademica', 15);
            $table->enum('categoriaUsuario', ['AlumnoLicenciatura', 'AlumnoPosgrado', 'Investigador', 'Docente', 'Administrativo', 'Externo'])->comment('Categoría principal del usuario.');
            $table->enum('estadoUsuario', ['Activo', 'Inactivo', 'Suspendido', 'PendienteConfirmacion'])->default('PendienteConfirmacion')->comment('Estado actual de la cuenta.');
            $table->unsignedBigInteger('idRolAdmin')->nullable()->comment('Rol administrativo asignado (si aplica). FK a rol_admin.'); // Asume que rol_admin.id es BigInt

            $table->rememberToken(); // Añade la columna remember_token

            // Timestamps personalizados (si los prefieres a created_at/updated_at)
             $table->dateTime('fechaRegistro')->useCurrent()->comment('Fecha y hora en que se creó la cuenta.');
             $table->dateTime('fechaUltimoAcceso')->nullable()->comment('Fecha y hora del último inicio de sesión exitoso.');
             // Si prefieres los estándar, comenta las dos líneas anteriores y descomenta la siguiente:
             // $table->timestamps();


            // Índices (algunos ya creados por unique())
            $table->index('idUnidadAcademica', 'fk_usuario_unidadacademica_idx');
            $table->index('idRolAdmin', 'fk_usuario_roladmin_idx');
            $table->index('categoriaUsuario', 'idx_usuario_categoria');
            $table->index('estadoUsuario', 'idx_usuario_estado');

            // Claves Foráneas
            // Asegúrate que el nombre 'UnidadAcademica' sea correcto
            $table->foreign('idUnidadAcademica', 'fk_usuario_unidadacademica')
                  ->references('idUnidadAcademica')->on('UnidadAcademica')
                  ->onDelete('RESTRICT')
                  ->onUpdate('CASCADE');

            // Asegúrate que el nombre 'rol_admin' y la PK 'id' sean correctos
            $table->foreign('idRolAdmin', 'fk_usuario_roladmin')
                  ->references('id')->on('rol_admin')
                  ->onDelete('SET NULL')
                  ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
