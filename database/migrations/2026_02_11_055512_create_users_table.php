<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Обязательные поля
            $table->id(); // Первичный ключ
            $table->string('name'); // Имя пользователя
            $table->string('email')->unique(); // Email
            $table->timestamp('email_verified_at')->nullable(); // Дата подтверждения email
            $table->string('password'); // Хэшированный пароль

            // Дополнительные поля (опционально)
            $table->enum('role', ['user', 'admin', 'guest'])->default('guest'); // Роль пользователя
            $table->string('avatar')->nullable(); // Путь к аватарке
            $table->string('phone')->nullable(); // Телефон
            $table->date('birthdate')->nullable(); // Дата рождения
            $table->text('bio')->nullable(); // О себе
            $table->string('website')->nullable(); // Веб-сайт
            $table->boolean('is_active')->default(true); // Активен ли пользователь
            $table->string('timezone')->default('UTC'); // Часовой пояс

            // Timestamps
            $table->rememberToken(); // Для "запомнить меня"
            $table->timestamps(); // created_at и updated_at

            // Индексы для ускорения запросов
            $table->index('role');
            $table->index('is_active');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
