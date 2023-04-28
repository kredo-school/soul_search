<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastAccessColumnInUserTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up()
     {
         Schema::table('user_tags', function (Blueprint $table) {
             $table->timestamp('last_access')->nullable();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('user_tags', function (Blueprint $table) {
             $table->dropColumn('last_access');
         });
     }
}
