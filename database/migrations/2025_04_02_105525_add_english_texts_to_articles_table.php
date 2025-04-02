<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->text('preview_text_en')->nullable();
            $table->longText('detail_text_en')->nullable();
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['preview_text_en', 'detail_text_en', 'title_en']);
        });
    }

};
