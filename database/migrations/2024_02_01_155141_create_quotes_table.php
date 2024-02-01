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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->enum('mode', ['binary', 'multiple_choice']);
            $table->string('answer_a')->nullable()->default(null);
            $table->string('answer_b')->nullable()->default(null);
            $table->string('answer_c')->nullable()->default(null);
            $table->enum('right_answer', ['0', '1', 'A', 'B', 'C',]);
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
        Schema::dropIfExists('quotes');
    }
};
