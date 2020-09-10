<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlagsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('flags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('request_id')->unsigned()->nullable();
            $table->string('ip_address');
            $table->string('flagged_date');
            $table->timestamps();
        });

        Schema::table('flags', function(Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('prayers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('flags');
    }

}
