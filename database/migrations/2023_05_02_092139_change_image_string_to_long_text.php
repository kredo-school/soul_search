<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeImageStringToLongText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->longText('image')->change();
        });
        Schema::table('media', function (Blueprint $table) {
            $table->longText('path')->change();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->longText('image')->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->longText('avatar')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->string('image', 255)->change();
        });
        Schema::table('media', function (Blueprint $table) {
            $table->string('path')->change();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image', 255)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar', 255)->change();
        });
    }
}
