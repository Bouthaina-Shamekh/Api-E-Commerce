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
        Schema::create('order_item_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('attribute_id')->nullable()->constrained('attributes', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('option_id')->nullable()->constrained('options', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('attribute_name');
            $table->string('option_name');
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
        Schema::dropIfExists('order_item_attributes');
    }
};
