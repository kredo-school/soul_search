<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('source_id');
            $table->enum('source', ['user','post','comment','tag','chat','message']);
            $table->enum('violation_type', ['communication','name','threat']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reporter_id')->references('id')->on('users');
            // $table->foreign('source_id', 'source_id_users')->references('id')->on('users');
            // $table->foreign('source_id', 'source_id_posts')->references('id')->on('posts');
            // $table->foreign('source_id', 'source_id_comments')->references('id')->on('comments');
            // $table->foreign('source_id', 'source_id_tags')->references('id')->on('tags');
            // $table->foreign('source_id', 'source_id_chats')->references('id')->on('chats');
            // $table->foreign('source_id', 'source_id_messages')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
