<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeysFromReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign('source_id_chats');
            $table->dropForeign('source_id_comments');
            $table->dropForeign('source_id_messages');
            $table->dropForeign('source_id_posts');
            $table->dropForeign('source_id_tags');
            $table->dropForeign('source_id_users');

            $table->dropIndex('source_id_messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('source_id', 'source_id_users')->references('id')->on('users');
            $table->foreign('source_id', 'source_id_posts')->references('id')->on('posts');
            $table->foreign('source_id', 'source_id_comments')->references('id')->on('comments');
            $table->foreign('source_id', 'source_id_tags')->references('id')->on('tags');
            $table->foreign('source_id', 'source_id_chats')->references('id')->on('chats');
            $table->foreign('source_id', 'source_id_messages')->references('id')->on('messages');
        });
    }
}
