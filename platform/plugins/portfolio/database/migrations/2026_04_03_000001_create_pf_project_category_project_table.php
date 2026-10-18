<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pf_project_category_project', function (Blueprint $table) {
            $table->foreignId('project_category_id');
            $table->foreignId('project_id');
            $table->primary(['project_category_id', 'project_id'], 'pf_project_category_project_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pf_project_category_project');
    }
};
