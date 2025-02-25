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
        Schema::create('model_lineups', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("モデル名");
            $table->string("detail")->comment("モデル説明");
            $table->integer("amount")->comment("モデル金額");
            $table->string("preview_file")->comment("モデル紹介画像");
            $table->string("download_file")->comment("モデルダウンロード");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_lineups');
    }
};
