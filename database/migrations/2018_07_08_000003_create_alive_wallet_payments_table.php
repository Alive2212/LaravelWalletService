<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAliveWalletPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alive_wallet_payments', function (Blueprint $table) {
            $table->increments('id');

            // Payment ID
            $table->text('payment_id');

            // Author
            $table->unsignedInteger('author_id')
                ->nullable()
                ->index();
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // From
            $table->unsignedInteger('from')
                ->index();
            $table->foreign('from')
                ->references('id')
                ->on('alive_wallet_bases')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // To
            $table->unsignedInteger('to')
                ->index();
            $table->foreign('to')
                ->references('id')
                ->on('alive_wallet_bases')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // For
            $table->unsignedInteger('for')
                ->index();
            $table->foreign('for')
                ->references('id')
                ->on('alive_wallet_stuffs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Amount
            $table->unsignedBigInteger('amount')
                ->default(0);

            // Balance
            $table->BigInteger('balance')
                ->nullable();

            // Extra Value
            $table->text('extra_value');

            // Description
            $table->text('description');

            // revoked
            $table->boolean('revoked')
                ->default(false);

            // locked
            $table->boolean('locked')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alive_wallet_payments');
    }
}
