<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')
            ->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('restrict');

            $table->unique(['category_id', 'name'], 'unique_identifier');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
