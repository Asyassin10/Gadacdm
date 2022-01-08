<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReqeustStatesIdToJoinProfRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('join_prof_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('reqeust_states_id')->default(1);
            $table->foreign("reqeust_states_id")->references("reqeust_states_id")->on("reqeust_states");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('join_prof_requests', function (Blueprint $table) {
            //
        });
    }
}
