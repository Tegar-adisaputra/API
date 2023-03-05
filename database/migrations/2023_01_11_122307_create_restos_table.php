<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->double('contact');
            $table->string('capacity')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('time')->default(now());
            $table->enum('category',['food','beverage'])->nullable();
            $table->binary('image')->nullable();
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
        Schema::dropIfExists('restos');
    }
};
