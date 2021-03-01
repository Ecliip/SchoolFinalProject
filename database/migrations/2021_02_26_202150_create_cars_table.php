<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
//            check
            $table->id();
            $table->double('price');
            $table->enum('engine', ['Gasolina, Diesel, Eléctrico', 'Mix']);
            $table->integer('power_hp');
            $table->integer ('kilometers');
            $table->integer ('doors');
            $table->enum('transmission', ['Automático', 'Manual']);
            $table->enum('traccion', ['Fwd', 'Rwd', 'Awd', 'x_4wd', 'x_4x4']);
            $table->date('year');
            $table->boolean('isNew');
            $table->boolean('isSold');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_model_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('cars');
    }
}
