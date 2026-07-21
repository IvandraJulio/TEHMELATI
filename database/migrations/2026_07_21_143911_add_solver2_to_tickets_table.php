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
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('solver2Id', 50)->nullable()->after('solverName');
            $table->string('solver2Name', 100)->nullable()->after('solver2Id');
            $table->index('solver2Id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex(['solver2Id']);
            $table->dropColumn(['solver2Id', 'solver2Name']);
        });
    }
};
