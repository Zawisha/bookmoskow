<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropcart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('user_id')->nullable();
            $table->text('user_email');
            $table->text('user_name')->nullable();
            $table->text('good_id');
            $table->text('good_name');
            $table->text('good_image');
            $table->integer('send')->default(0);
            $table->integer('timer')->default(0);

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
        Schema::dropIfExists('dropcart');
    }
}
