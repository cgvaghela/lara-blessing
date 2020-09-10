<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('metadata', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('url');
			$table->string('title')->nullable();
			$table->string('meta_title')->nullable();
			$table->string('meta_keywords')->nullable();
			$table->text('meta_description')->nullable();
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
        //
    }
}
