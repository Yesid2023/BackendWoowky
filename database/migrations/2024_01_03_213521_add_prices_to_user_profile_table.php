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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->decimal('lodging_price', 10, 2)->nullable()->after('dribbble_link');
            $table->decimal('kindergarten_price', 10, 2)->nullable()->after('lodging_price');
            $table->decimal('complete_care_price', 10, 2)->nullable()->after('kindergarten_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {

            $table->dropColumn('lodging_price');
            $table->dropColumn('kindergarten_price');
            $table->dropColumn('complete_care_price');
        });
    }
};
