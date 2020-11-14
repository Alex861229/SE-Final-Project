<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kr_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 5000);
            $table->string('address1', 1000);
            $table->string('address2', 1000);
            $table->decimal('longitude', 10, 5);
            $table->decimal('latitude', 10, 5);
            $table->string('parkinginfo', 100);
            $table->string('public_facility', 1000);
            $table->string('accommodation', 1000);
            $table->string('sports_facility', 1000);
            $table->string('entertainment_facility', 1000);
            $table->string('support_facility', 1000);
            $table->string('name_kr', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kr_table', function (Blueprint $table) {
            //
        });
    }
}
