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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('master_image');
            $table->string('description_ar');
            $table->string('description_en');
            $table->double('price');
            $table->double('discount');
            $table->string('general_info_ar');
            $table->string('general_info_en');
            $table->string('specefications_ar');
            $table->string('specefications_en');
            $table->enum('status' , ['ACTIVE' , 'INACTIVE'])->default('ACTIVE');
            $table->enum('type' , ['ALL' , 'NEW' , 'MOSTBOUGHT' , 'MOSTWATCHED' , 'MOSTFAVOURITE'])->default('ALL');
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
        Schema::dropIfExists('products');
    }
};
