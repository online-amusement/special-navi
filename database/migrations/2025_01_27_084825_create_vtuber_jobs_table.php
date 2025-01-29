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
        Schema::create('vtuber_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_tag_id")->comment("種別ID");
            $table->string('name')->comment("名前");
            $table->tinyInteger("status")->default(0)->comment("0:表示 1:非表示");
            $table->timestamps();

            $table->foreign('category_tag_id')->references('id')->on('category_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vtuber_jobs');
    }
};
