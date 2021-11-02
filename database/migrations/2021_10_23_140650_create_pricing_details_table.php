<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_details', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->double('price', 100);
            $table->string('duration', 100);
            $table->text('description');
            $table->string('deleted_at', 100)->nullable();
            $table->string('slug', 100);
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
        Schema::dropIfExists('pricing_details');
    }
}
