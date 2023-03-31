<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocietyIdToFundRaisingCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fund_raising_collections', function (Blueprint $table) {
            $table->bigInteger('society_id')->unsigned()->nullable();
            $table->foreign('society_id')->references('id')->on('societies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fund_raising_collections', function (Blueprint $table) {
            $table->dropColumn('society_id');
        });
    }
}
