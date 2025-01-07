<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string("name")->nullable()->change();
            $table->string("password", 64)->nullable()->change();
            $table->string("postal_code")->nullable()->change();
            $table->string("address")->nullable()->change();
            $table->integer("tel")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string("name")->nullable(false)->change();
            $table->string("password", 64)->nullable(false)->change();
            $table->string("postal_code")->nullable(false)->change();
            $table->string("address")->nullable(false)->change();
            $table->integer("tel")->nullable(false)->change();
        });
    }
};
