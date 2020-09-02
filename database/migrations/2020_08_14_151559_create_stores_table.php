<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50)->unique();
            $table->text('description');
            $table->text('logo_uri')->nullable();
            $table->string('slogan', 100)->nullable();
            $table->string('db_username', 100);
            $table->string('db_password', 100);
            $table->string('db_uri', 100);
            $table->string('store_uri', 100);
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('stores');
    }
}
