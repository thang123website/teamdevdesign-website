<?php

use Botble\Base\Enums\BaseStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('pf_project_categories', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('parent_id')->nullable()->index();
            $table->string('name');
            $table->string('description', 400)->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->string('status')->default(BaseStatusEnum::PUBLISHED);
            $table->timestamps();
        });

        Schema::create('pf_project_categories_translations', function (Blueprint $table): void {
            $table->string('lang_code');
            $table->foreignId('pf_project_categories_id');
            $table->string('name', 255)->nullable();
            $table->string('description', 400)->nullable();

            $table->primary(['lang_code', 'pf_project_categories_id'], 'pf_project_categories_translations_primary');
        });

        // Thêm cột category_id vào bảng pf_projects nếu chưa có
        if (!Schema::hasColumn('pf_projects', 'category_id')) {
            Schema::table('pf_projects', function (Blueprint $table): void {
                $table->foreignId('category_id')->nullable()->index()->after('id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pf_project_categories_translations');
        Schema::dropIfExists('pf_project_categories');

        if (Schema::hasColumn('pf_projects', 'category_id')) {
            Schema::table('pf_projects', function (Blueprint $table): void {
                $table->dropColumn('category_id');
            });
        }
    }
};
