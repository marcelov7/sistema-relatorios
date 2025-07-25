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
        Schema::table('relatorios', function (Blueprint $table) {
            $table->dropForeign(['equipment_id']);
            $table->dropColumn(['equipment_id', 'equipment_tag']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('relatorios', function (Blueprint $table) {
            $table->foreignId('equipment_id')->nullable()->constrained('equipamentos')->onDelete('set null');
            $table->string('equipment_tag')->nullable();
        });
    }
};
