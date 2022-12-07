<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('script_name', 25);
            $table->integer('start_time');
            $table->integer('end_time');
            $table->enum('result', ['normal', 'illegal', 'failed', 'success']); // можно было отдельной таблицей
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
