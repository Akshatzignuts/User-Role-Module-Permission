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
        Schema::create('modules', function (Blueprint $table) {
            $table->string('code', 16)->primary();
            $table->string('name', 64);
            $table->string('description', 255)->nullable();
            $table->string('parent_module_code', 16)->nullable();
            $table->foreign('parent_module_code')->references('code')->on('modules')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->references('code')->on('modules');
            $table->foreign('updated_by')->references('code')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
