<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('people')) {
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('name')->index();
            $table->string('appellative')->index()->nullable();

            $table->string('nin')->nullable()->unique();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();

            $table->string('bank')->nullable();
            $table->string('bank_account')->nullable();

            $table->text('notes')->nullable();

            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::table('users', fn (Blueprint $table) => ($table->foreign('person_id')->references('id')->on('people')));
    }
    }

    public function down()
    {
        Schema::table('users', fn (Blueprint $table) => ($table->dropForeign(['person_id'])));

        Schema::dropIfExists('people');
    }
};
