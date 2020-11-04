<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('rider_id');
            $table->string('start_location');
            $table->text('via_location');
            $table->string('end_location');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('no_of_people');
            $table->text('short_description')->nullable();
            $table->text('ride_days');
            $table->float('total_km')->default(0);
            $table->text('luggage')->nullable();
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
        Schema::dropIfExists('events');
    }
}
