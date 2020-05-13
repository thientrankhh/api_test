<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// STATUS
// 0 - pending
// 1 - accepted
// 2 - denied
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
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('creator_id');
            $table->string('member_ids');
            $table->dateTime('from', 0);
            $table->dateTime('to', 0);
            $table->uuid('approval_id');
            $table->string('reason');
            $table->unsignedSmallInteger('status');     // 0 - pending, 1 - accepted, 2 - denied
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('approval_id')->references('id')->on('users');
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
