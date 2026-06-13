<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('service_categories')
            ->where('slug', 'thu-vien-ho-so')
            ->update([
                'name' => 'Văn bản pháp luật',
                'description' => 'Hệ thống văn bản pháp luật về môi trường và khí hậu',
            ]);
    }

    public function down(): void
    {
        DB::table('service_categories')
            ->where('slug', 'thu-vien-ho-so')
            ->update([
                'name' => 'Thư viện & Hồ sơ',
                'description' => 'Hồ sơ năng lực và hệ thống văn bản pháp luật môi trường',
            ]);
    }
};
