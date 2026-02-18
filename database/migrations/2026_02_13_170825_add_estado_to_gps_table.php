<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gps', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('contrasena');
        });
    }

    public function down()
    {
        Schema::table('gps', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
