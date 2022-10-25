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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('media_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('slug');
            $table->integer('time');
            $table->integer('priority')->nullable();

            $table->enum('status', \Shofo\Course\Models\Lesson::$confirmation);

            $table->enum('free',\Shofo\Course\Models\Lesson::$caching)->default(\Shofo\Course\Models\Lesson::CASH_ON);
            $table->longText('body')->nullable();

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
        Schema::dropIfExists('lessons');
    }
};
