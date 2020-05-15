<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('creator_id')->nullable();
            $table->string('member_ids');
            $table->dateTime('from', 0);
            $table->dateTime('to', 0);
            $table->uuid('approver_id')->nullable();
            $table->string('reason');
            $table->unsignedSmallInteger('status')->default(0)->comment('0 - pending, 1 - accepted, 2 - denied');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('overtimes');
    }
}
