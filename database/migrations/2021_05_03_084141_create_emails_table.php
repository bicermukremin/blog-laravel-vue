<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->longText('content')->nullable();
            $table->string('konu');
            $table->string('email');
            $table->string('from')->default('bicermukremin86@gmail.com');
            $table->string('ad_soyad')->nullable();
            $table->enum('type', ['contact','abone','yorum','reply'])->default('contact');
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
        Schema::dropIfExists('emails');
    }
}