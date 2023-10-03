<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();// id (Int Auto-increment primary key)
            $table->unsignedBigInteger('user_id'); //user_id (int foreign key table users)
            $table->string('title'); //title (String)
            $table->text('description'); //description (Text)
            $table->boolean('completed'); //completed (Boolean)
            $table->timestamp('created_at'); //created_at (Timestamps)
            $table->foreign('user_id') //user_id (int foreign key table users)
              ->references('id')
              ->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');
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
        Schema::dropIfExists('tasks');
    }
};
