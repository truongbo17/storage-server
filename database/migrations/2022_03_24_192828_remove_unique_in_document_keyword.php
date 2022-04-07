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
        Schema::table('document_keyword', function (Blueprint $table) {
            $table->dropUnique("document_keyword_keyword_id_unique");
            $table->dropUnique("document_keyword_document_id_unique");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_keyword', function (Blueprint $table) {
            $table->unique(['document_id', 'keyword_id']);
        });
    }
};
