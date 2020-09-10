<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrayedforTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prayedfor', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('request_id')->unsigned()->nullable();
            $table->string('prayedfor_date');
            $table->string('ip_address');
            $table->timestamps();
        });

        Schema::table('prayedfor', function(Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('prayers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prayedfor');
    }

}
