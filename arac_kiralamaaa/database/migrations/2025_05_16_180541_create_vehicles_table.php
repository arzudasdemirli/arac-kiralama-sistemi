<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('marka');
        $table->string('model');
        $table->string('vites');
        $table->string('yakit');
        $table->integer('koltuk');
        $table->decimal('fiyat', 8, 2);
        $table->string('resim');
        $table->boolean('is_rented')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
