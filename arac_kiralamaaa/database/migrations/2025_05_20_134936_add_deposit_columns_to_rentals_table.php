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
    Schema::table('rentals', function (Blueprint $table) {
        $table->decimal('deposit_amount', 10, 2)->nullable();
        $table->boolean('deposit_paid')->default(false);
    });
}

    /**
     * Reverse the migrations.
     */
    
public function down()
{
    Schema::table('rentals', function (Blueprint $table) {
        $table->dropColumn(['deposit_amount', 'deposit_paid']);
    });
}
};
