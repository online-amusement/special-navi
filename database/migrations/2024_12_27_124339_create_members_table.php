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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("氏名");
            $table->string("email", 128)->comment("メールアドレス");
            $table->string("password", 64)->comment("パスワード");
            $table->string("api_token", 80)->nullable()->comment("トークン");
            $table->string("postal_code")->comment("郵便番号");
            $table->string("address")->comment("住所");
            $table->integer("tel")->comment("電話番号");
            $table->tinyInteger("status")->comment("0:仮登録 1:通常 2:退会");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
