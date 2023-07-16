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
        Schema::create('variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->nullable()->constrained('variants', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('attribute_id')->nullable()->constrained('attributes', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('option_id')->nullable()->constrained('options', 'id')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('variant_attributes');
    }
};
