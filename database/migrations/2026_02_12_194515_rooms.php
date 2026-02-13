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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            // Número de habitación (único)
            $table->string('number')->unique();
            // Relación con pisos
            $table->foreignId('floor_id')->constrained('floors', 'id');
            // Relación con tipos de habitación
            $table->foreignId('room_type_id')->constrained('room_types', 'id');
            // Precio de la habitación
            $table->decimal('price', 10, 2);
            // Características (opcional)
            $table->text('characteristics')->nullable();
            // Estado de la habitación
            $table->enum('state', ['libre','ocupada','limpieza','mantenimiento','reservado'])->default('libre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
