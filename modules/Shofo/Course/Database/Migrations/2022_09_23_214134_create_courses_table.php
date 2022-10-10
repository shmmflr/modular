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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('teacher_id')->constrained();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('banner_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->float('priority');
            $table->string('price', 10)->nullable();
            $table->string('percent', 5);
            $table->enum('type', \Shofo\Course\Models\Course::$types);
            $table->enum('status', \Shofo\Course\Models\Course::$statuses);
            $table->enum('confirmation', \Shofo\Course\Models\Course::$confirmation);
            $table->text('body')->nullable();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')
                ->on('users')->onDelete('CASCADE');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('SET NULL');
            $table->foreign('banner_id')->references('id')
                ->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
