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
        Schema::create('checklist_details', function (Blueprint $table) {
            $table->id();
            $table->string("itemName");
            $table->boolean("status")->default(0);
            $table->unsignedBigInteger("checklistId");
            $table->timestamps();
            $table->foreign('checklistId')->references('id')->on('checklists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_details');
    }
};
