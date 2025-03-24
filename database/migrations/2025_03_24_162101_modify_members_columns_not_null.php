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
            $table->string('name', 255)->default('')->change();
            $table->string('password', 64)->default('')->change();
            $table->string('postal_code', 255)->default('')->change();
            $table->string('address', 255)->default('')->change();
            $table->string('address2', 255)->default('')->change();
            $table->string('address3', 255)->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('name', 255)->nullable()->default(null)->change();
            $table->string('password', 64)->nullable()->default(null)->change();
            $table->string('postal_code', 255)->nullable()->default(null)->change();
            $table->string('address', 255)->nullable()->default(null)->change();
            $table->string('address2', 255)->nullable()->default(null)->change();
            $table->string('address3', 255)->nullable()->default(null)->change();
        });
    }
};
