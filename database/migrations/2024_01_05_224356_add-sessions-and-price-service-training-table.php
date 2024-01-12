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
        Schema::table('service_training', function (Blueprint $table) {
            $table->integer('sessions')->default(1)->after('description');
            $table->decimal('price', 10, 2)->nullable()->after('sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_training', function (Blueprint $table) {

            $table->dropColumn('sessions');
            $table->dropColumn('price');
        });
    }
};
