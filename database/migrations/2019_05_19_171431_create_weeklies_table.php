<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('weeklies', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('edition');
            $table->dateTime('released_at');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->dateTime('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('weeklies');
    }
}
