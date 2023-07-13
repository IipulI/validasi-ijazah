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
        Schema::create('rektor', function (Blueprint $table) {
            $table->id('id_rektor');
            $table->string('nama');
            $table->boolean('status_jabatan');
            $table->int('tahun_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rektor');
    }
};
