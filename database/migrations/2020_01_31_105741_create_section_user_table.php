<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_user', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['section_id', 'user_id']);
            $table->foreign('section_id', 'section_fk')->references('id')
                ->on('sections')->onDelete('cascade');
            $table->foreign('user_id', 'user_fk')->references('id')
                ->on('users')->onDelete('cascade');

            $table->unique(['section_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_user');
    }
}
