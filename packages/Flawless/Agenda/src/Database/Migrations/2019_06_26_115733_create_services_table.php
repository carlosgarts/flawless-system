<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->string('name', 191)->nullable();
            $table->float('price', 8, 2);
            $table->integer('duration');
            $table->integer('available')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
