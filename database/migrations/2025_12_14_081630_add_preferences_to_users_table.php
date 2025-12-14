<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('language')->default('id'); // id atau en
            $table->string('theme')->default('light'); // light atau dark
            $table->boolean('email_notification')->default(true); // Opsi on/off notifikasi
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['language', 'theme', 'email_notification']);
        });
    }
};
