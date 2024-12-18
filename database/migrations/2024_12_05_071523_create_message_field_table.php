<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageFieldTable extends Migration
{
    public function up()
    {
        Schema::create('message_field', function (Blueprint $table) {
            $table->id();  
            $table->string('image'); 
            $table->json('json');  
            $table->string('text');  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_field');
    }
}