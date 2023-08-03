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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_name');
            $table->string('app_icon')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('opening')->nullable();
            $table->string('closing')->nullable();
            $table->string('ticket_starts')->nullable();
            $table->text('message')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
};
