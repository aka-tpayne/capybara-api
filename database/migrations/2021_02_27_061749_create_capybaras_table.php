<?php

use App\Models\Capybara;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapybarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capybaras', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color');
            $table->string('size');
            $table->timestamps();
        });

        Capybara::create(
            [
                'name' => 'Colossus',
                'color' => 'Grey',
                'size' => 'Colossal',
            ],
        );
        Capybara::create(
            [
                'name' => 'Steven',
                'color' => 'Red',
                'size' => 'Medium',
            ],
        );
        Capybara::create(
            [
                'name' => 'Capybaby',
                'color' => 'Blue',
                'size' => 'Small',
            ],
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capybaras');
    }
}
