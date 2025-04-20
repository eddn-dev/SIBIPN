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
            // PK UUID
            $table->uuid('id')->primary()->comment('PK UUID para el usuario');

            // --- NUEVOS CAMPOS DE NOMBRE ---
            $table->string('nombre', 100)->comment('Nombre(s) del usuario.');
            $table->string('p_apellido', 100)->comment('Primer apellido del usuario.');
            $table->string('s_apellido', 100)->nullable()->comment('Segundo apellido del usuario (opcional).');
            // --- FIN NUEVOS CAMPOS ---

            // $table->string('nombreCompleto', 255)->comment('Nombre(s) y Apellidos del usuario.'); // <-- Campo anterior eliminado

            $table->string('boleta', 10)->unique()->comment('Boleta o número de empleado del usuario.');
            $table->string('email', 255)->unique()->comment('Correo electrónico institucional.');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->comment('Hash de la contraseña.');

            // Campos personalizados SIBIPN
            $table->string('idUnidadAcademica', 15);
            $table->enum('categoriaUsuario', ['AlumnoBachillerato', 'AlumnoLicenciatura', 'AlumnoPosgrado', 'Investigador', 'Docente', 'Administrativo', 'Externo'])->comment('Categoría principal del usuario.'); // Añadido AlumnoBachillerato
            $table->enum('estadoUsuario', ['Activo', 'Inactivo', 'Suspendido', 'PendienteConfirmacion'])->default('PendienteConfirmacion')->comment('Estado actual de la cuenta.');
            $table->unsignedBigInteger('idRolAdmin')->nullable()->comment('Rol administrativo asignado (si aplica). FK a rol_admin.');

            $table->rememberToken();

            // Timestamps (usando los estándar de Laravel ahora para simplicidad)
            $table->timestamps(); // Esto crea created_at y updated_at
            // $table->dateTime('fechaRegistro')->useCurrent()->comment('Fecha y hora en que se creó la cuenta.'); // Comentado
            // $table->dateTime('fechaUltimoAcceso')->nullable()->comment('Fecha y hora del último inicio de sesión exitoso.'); // Comentado


            // Índices
            $table->index('idUnidadAcademica', 'fk_usuario_unidadacademica_idx');
            $table->index('idRolAdmin', 'fk_usuario_roladmin_idx');
            $table->index('categoriaUsuario', 'idx_usuario_categoria');
            $table->index('estadoUsuario', 'idx_usuario_estado');
            // Podrías añadir índices combinados para apellidos si buscas mucho por nombre completo
            // $table->index(['p_apellido', 's_apellido', 'nombre']);

            // Claves Foráneas (Asegúrate que los nombres de tabla/columna referenciados sean correctos)
            $table->foreign('idUnidadAcademica', 'fk_usuario_unidadacademica')
                  ->references('idUnidadAcademica')->on('UnidadAcademica') // Asume tabla 'UnidadAcademica'
                  ->onDelete('RESTRICT')
                  ->onUpdate('CASCADE');

            $table->foreign('idRolAdmin', 'fk_usuario_roladmin')
                  ->references('id')->on('rol_admin') // Asume tabla 'rol_admin' con PK 'id'
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