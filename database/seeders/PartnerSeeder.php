<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'GreenLoop Agriculture',
                'logo' => 'partners/greenloop.svg',
                'website_url' => 'https://example.com/partners/greenloop',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'EcoGrid Energy',
                'logo' => 'partners/ecogrid.svg',
                'website_url' => 'https://example.com/partners/ecogrid',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Circular Lab',
                'logo' => 'partners/circular-lab.svg',
                'website_url' => 'https://example.com/partners/circular-lab',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Net Zero Alliance',
                'logo' => 'partners/net-zero.svg',
                'website_url' => 'https://example.com/partners/net-zero',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'GreenTech University',
                'logo' => 'partners/greentech.svg',
                'website_url' => 'https://example.com/partners/greentech',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Sustainable Future Fund',
                'logo' => 'partners/sustainable-future.svg',
                'website_url' => 'https://example.com/partners/sustainable-future',
                'sort_order' => 6,
                'is_active' => true,
            ],
            // 10 partners mới
            [
                'name' => 'VNPT Technology Corp.',
                'logo' => 'partners/vnpt.svg',
                'website_url' => 'https://vnpt.com.vn',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'FPT Software Solutions',
                'logo' => 'partners/fpt.svg',
                'website_url' => 'https://fpt.com.vn',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Bộ Nông nghiệp và PTNT',
                'logo' => 'partners/mard.svg',
                'website_url' => 'https://mard.gov.vn',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'UNDP Việt Nam',
                'logo' => 'partners/undp.svg',
                'website_url' => 'https://www.undp.org/vietnam',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Ngân hàng Phát triển Châu Á',
                'logo' => 'partners/adb.svg',
                'website_url' => 'https://www.adb.org',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'WWF World Wildlife Fund',
                'logo' => 'partners/wwf.svg',
                'website_url' => 'https://wwf.panda.org',
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'IUCN Conservation Union',
                'logo' => 'partners/iucn.svg',
                'website_url' => 'https://www.iucn.org',
                'sort_order' => 13,
                'is_active' => true,
            ],
            [
                'name' => 'VCCI Phòng TM & CN Việt Nam',
                'logo' => 'partners/vcci.svg',
                'website_url' => 'https://www.vcci.com.vn',
                'sort_order' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'GIZ Deutsche Gesellschaft',
                'logo' => 'partners/giz.svg',
                'website_url' => 'https://www.giz.de',
                'sort_order' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Bộ Tài nguyên và Môi trường',
                'logo' => 'partners/monre.svg',
                'website_url' => 'https://monre.gov.vn',
                'sort_order' => 16,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Storage::disk('public')->put(
                $partner['logo'],
                file_get_contents(database_path('seeders/assets/'.$partner['logo'])),
            );

            Partner::query()->updateOrCreate(
                ['name' => $partner['name']],
                $partner,
            );
        }
    }
}
