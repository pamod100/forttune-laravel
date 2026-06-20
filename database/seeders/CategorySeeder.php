<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptops & Notebooks', 'icon' => '💻'],
            ['name' => 'Desktops & AIO', 'icon' => '🖥️'],
            ['name' => 'Printers & Scanners', 'icon' => '🖨️'],
            ['name' => 'Networking', 'icon' => '📡'],
            ['name' => 'Monitors', 'icon' => '📺'],
            ['name' => 'Servers & Storage', 'icon' => '🗄️'],
            ['name' => 'Peripherals', 'icon' => '⌨️'],
            ['name' => 'CCTV & Security', 'icon' => '📷'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                ['name' => $cat['name'], 'icon' => $cat['icon']]
            );
        }
    }
}
