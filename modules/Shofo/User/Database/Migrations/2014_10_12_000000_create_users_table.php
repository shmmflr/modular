<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile', 14)->nullable();
            $table->string('username', 50)->nullable();
            $table->text('bio')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->enum('status', \Shofo\User\Models\User::$statuses)->default(\Shofo\User\Models\User::STATUS_ACTIVE);
            $table->foreignId('image_id')->constrained()->nullOnDelete()->onUpdate('CASCADE');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
