<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('notifiable_id'); // The user ID who will receive the notification
            $table->string('notifiable_type'); // The model type (e.g., User)
            $table->string('type'); // Type of notification (e.g., NewOrderCreated)
            $table->text('data'); // JSON data for the notification
            $table->boolean('read')->default(false); // Read status
            $table->timestamp('read_at')->nullable(); // Add the read_at column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
