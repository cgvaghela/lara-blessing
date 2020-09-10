<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrayersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prayers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('anon', ['0', '1'])->default('1');
            $table->string('email');
            $table->string('authcode');
            $table->enum('submitted', ['0'])->default('0');
            $table->enum('closed', ['0'])->default('0');
            $table->text('closed_comment')->nullable();
            $table->string('title');
            $table->string('body');
            $table->enum('notify', ['0', '1'])->default('1');
            $table->string('ip_address');
            $table->enum('active', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prayers');
    }

}
