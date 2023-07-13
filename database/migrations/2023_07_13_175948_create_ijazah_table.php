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
        Schema::create('ijazah', function (Blueprint $table) {
            $table->string('no_ijazah')->primary();
            $table->string('unviersitas');
            $table->string('tanggal_keluar');
            $table->string('npm');
            $table->string('path_img');
            $table->int('id_fakultas');
            $table->int('id_gelar');
            $table->int('id_rektor');
            $table->int('id_admin');
            $table->timestamp('validated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ijazah');
    }
};
