<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('website')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('hotline')->nullable();
            $table->string('email')->nullable();
            $table->text('logo')->nullable();
            $table->text('banner')->nullable();
            $table->text('icon')->nullable();
            $table->text('description')->nullable();
            $table->text('thead')->nullable();
            $table->text('tbody')->nullable();
            $table->text('robot')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('meta_key')->nullable();
            $table->text('meta_des')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
