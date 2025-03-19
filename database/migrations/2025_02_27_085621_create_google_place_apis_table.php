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
        Schema::create('google_place_apis', function (Blueprint $table) {
            $table->id();
            $table->double("lat")->nullable()->comment("緯度");
            $table->double("lng")->nullable()->comment("経度");
            $table->string("icon")->nullable()->comment("アイコン");
            $table->string("name")->nullable()->comment("店名");
            $table->boolean("open_now")->nullable()->comment("開店してるかどうかの判定");
            $table->string("photos")->nullable()->comment("写真");
            $table->string("place_id")->nullable()->comment("各施設に固有の識別子");
            $table->string("plus_code")->nullable()->comment("住所情報が不十分な場所を示す補助コード");
            $table->integer("price_level")->nullable()->comment("価格帯を示す数値");
            $table->double("rating")->nullable()->comment("施設に対するユーザーの平均評価");
            $table->integer("user_ratings_total")->nullable()->comment("その施設に対する総レビュー数");
            $table->string("vicinity")->comment("施設の位置情報の簡易な住所表記");
            $table->string("types")->nullable()->comment("カテゴリー");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_place_apis');
    }
};
