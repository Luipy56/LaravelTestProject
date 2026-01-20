<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuaris_admin', function (Blueprint $table) {
            $table->id();
            $table->string('usuari', 50);
            $table->string('contraseña', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuaris_admin');
    }
};
