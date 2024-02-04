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
        Schema::table('guest_users', function (Blueprint $table) {
            $table->tinyInteger('unanswered_questions')->default(0);
            $table->foreignId('questionnaire_id')->nullable()->constrained()->onDelete('set null');
            $table->dateTime('submit_time_utc')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_users', function (Blueprint $table) {
            $table->dropColumn('unanswered_questions');
            $table->dropForeign(['questionnaire_id']);
            $table->dropColumn('submit_time_utc');
        });
    }
};
