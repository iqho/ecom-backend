<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->boolean('is_active')->default(true);
            $table->timestamps(); 
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
