<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaiwanSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taiwan_site', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('description', 5000);
            $table->string('address', 1000);
            $table->decimal('longitude', 10, 5);
            $table->decimal('latitude', 10, 5);
            $table->string('parkinginfo', 100);
            $table->string('ticketinfo', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taiwan_site', function (Blueprint $table) {
            //
        });
    }
}
