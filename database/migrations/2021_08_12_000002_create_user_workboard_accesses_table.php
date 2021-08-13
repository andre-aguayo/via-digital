<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWorkboardAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workboard_accesses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('workboard_id')
                ->references('id')
                ->on('workboards');

            $table->unsignedBigInteger('workboard_acess_type_id')
                ->references('id')
                ->on('workboard_access_types')
                ->default(1);

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
        Schema::dropIfExists('user_workboard_accesses');
    }
}
