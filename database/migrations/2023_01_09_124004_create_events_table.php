<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->string('title');
            $table->string('desc');
            $table->timestamps();
            $table->dateTime('event_start_time', 0);
            $table->dateTime('event_end_time', 0);
            $table->dateTime('event_deadline', 0);
            $table->boolean('approved');
            $table->bigInteger('approved_by')->nullable();
            $table->integer('economy_seats');
            $table->integer('economy_price');
            $table->integer('vip_seats');
            $table->integer('vip_price');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}

