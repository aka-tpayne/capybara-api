<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapybaraObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capybara_observations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('capybara_id');
            $table->date('date');
            $table->string('city');
            $table->boolean('wearing_hat')->default(false);
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
        Schema::dropIfExists('capybara_observations');
    }
}
