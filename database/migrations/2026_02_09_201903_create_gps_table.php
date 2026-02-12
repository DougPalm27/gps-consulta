<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gps', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transporte_id')
                  ->constrained('transportes')
                  ->cascadeOnDelete();

            $table->string('tipo_vehiculo', 50);
            $table->string('placa', 20);

            $table->string('plataforma', 50)->nullable();
            $table->string('destino', 150)->nullable();

            $table->string('usuario', 100)->nullable();
            $table->string('contrasena', 150)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gps');
    }
};
