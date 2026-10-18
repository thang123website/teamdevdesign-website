<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('pf_projects', 'programming_languages')) {
            Schema::table('pf_projects', function (Blueprint $table) {
                $table->string('programming_languages', 400)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pf_projects', 'programming_languages')) {
            Schema::table('pf_projects', function (Blueprint $table) {
                $table->dropColumn('programming_languages');
            });
        }
    }
};
