<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsLoginToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean("is_online");
            //$table->dateTime('time_online');
            $table->timestamp('time_online')->useCurrent();
            $table->timestamp('time_LogOut')->useCurrent();
            //$table->dateTime("time_LogOut");
            $table->integer("duration_connection_minutes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
