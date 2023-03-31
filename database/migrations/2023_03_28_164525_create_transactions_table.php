<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->decimal('amount');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('cf_order_id')->comment("This is the identifier for this order in Cashfree's system.");
            $table->string('order_id')->comment("Order Id provided by the merchant. If merchant does not provide an order id then it will remain same as we passes to cashfree.");
            $table->string('order_currency');
            $table->enum('order_status', ['ACTIVE', 'PAID', 'EXPIRED']);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
