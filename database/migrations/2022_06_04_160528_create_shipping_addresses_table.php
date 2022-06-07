<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');

            $table->string('name', 100);
            $table->text('address');
            $table->string('upazila', 100);
            $table->string('district', 100);
            $table->string('country', 100);
            $table->string('zip_code', 10)->nullable();
            $table->string('mobile', 50);
            $table->string('mobile_2', 50)->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
