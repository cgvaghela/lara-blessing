<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePraiseReportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('praise_reports', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('request_id')->unsigned()->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });

        Schema::table('praise_reports', function(Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('prayers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('praise_reports');
    }

}
