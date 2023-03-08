<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTalentColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', 60)->nullable()->after('avatar');
            $table->string('country', 60)->nullable()->after('gender');
            $table->string('city', 60)->nullable()->after('country');
            $table->text('description')->nullable()->after('city');
            $table->enum('talent_status', ['active', 'non-active'])->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('description');
            $table->dropColumn('talent_status');
        });
    }
}