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
        Schema::create('permission_module', function (Blueprint $table) {
            $table->string('module_code');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('module_code')->references('code')->on('modules');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->tinyInteger('view');
            $table->tinyInteger('add');
            $table->tinyInteger('edit');
            $table->tinyInteger('delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_module');
    }
};