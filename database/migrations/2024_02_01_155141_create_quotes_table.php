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
            $table->string('answer1')->nullable()->default(null);
            $table->string('answer2')->nullable()->default(null);
            $table->string('answer3')->nullable()->default(null);
            $table->timestamps();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('answer1', 'answer_a');
            $table->renameColumn('answer2', 'answer_b');
            $table->renameColumn('answer3', 'answer_c');
            $table->string('right_answer', 10);
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
