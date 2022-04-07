<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_keyword', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("keyword_id")
                ->index()
                ->unique()
                ->foreignId('keyword_id')
                ->references('id')
                ->on('keywords')
                ->onDelete('cascade');
            $table->unsignedBigInteger("document_id")
                ->index()
                ->unique()
                ->foreignId('document_id')
                ->references('id')
                ->on('documents')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_keyword');
    }
};
