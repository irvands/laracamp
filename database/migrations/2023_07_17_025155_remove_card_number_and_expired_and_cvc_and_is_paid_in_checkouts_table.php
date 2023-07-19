<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCardNumberAndExpiredAndCvcAndIsPaidInCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Checkouts', function (Blueprint $table) {
            $table->dropColumn(['card_number', 'expired', 'cvc', 'is_paid','card_holder']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Checkouts', function (Blueprint $table) {
            $table->string('card_number', 20)->nullable();
            $table->date('expired')->nullable();
            $table->string('cvc', 3)->nullable();
            $table->boolean('is_paid')->default(false);
        });
    }
}
