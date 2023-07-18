<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMidtransUrlInTableCheckouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Checkouts', function (Blueprint $table) {
            $table->dropColumn('midtrans_url');
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
            $table->string('midtrans_url')->nullable()->after('payment_status');
        });
    }
}
