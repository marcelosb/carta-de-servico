<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretaries', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('name');
            $table->string('theme');
            $table->string('theme_slug');
            $table->string('address');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('opening_hours');
            $table->string('icon')->default('default');
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
        Schema::dropIfExists('secretaries');
    }
}
