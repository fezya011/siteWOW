<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('category')->nullable();
            $table->string('author')->nullable();
            $table->string('author_initials', 2)->nullable(); // КОЛОНКА ДОЛЖНА БЫТЬ!
            $table->text('excerpt')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index('user_id'); // Индекс
        });

        // Проверим создание через SQL запрос
        echo "Таблица posts создана\n";
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
