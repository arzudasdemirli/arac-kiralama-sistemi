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
    Schema::table('vehicles', function (Blueprint $table) {
        $table->string('kasko_durumu')->nullable();         // Örneğin: "Kaskolu"
        $table->string('sigorta')->nullable();              // Zorunlu trafik sigortası
        $table->string('km_siniri')->nullable();            // Günlük 300 km
        $table->string('teslimat')->nullable();             // Aynı şehir içinde ücretsiz teslimat
        $table->text('ozel_not')->nullable();               // Ek bilgiler
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
        });
    }
};
