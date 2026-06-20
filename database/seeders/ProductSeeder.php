<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $laptops = Category::where('slug', 'laptops-notebooks')->first();
        $monitors = Category::where('slug', 'monitors')->first();
        $networking = Category::where('slug', 'networking')->first();
        $printers = Category::where('slug', 'printers-scanners')->first();

        $products = [
            [
                'category_id' => $laptops?->id,
                'name' => 'EliteBook 8 G1i — Ultra 7 14th Gen',
                'brand' => 'HP',
                'price' => 503000,
                'processor' => 'Intel Ultra 7',
                'ram' => '16GB DDR5',
                'storage' => '512GB SSD',
                'display' => '14" FHD',
                'warranty' => '3 Years',
                'stock_status' => 'in_stock',
                'stock_qty' => 5,
                'is_featured' => true,
                'description' => 'Premium business laptop with the latest Intel Ultra processor, built for professionals who need power and portability.',
            ],
            [
                'category_id' => $laptops?->id,
                'name' => 'Inspiron 3530 — 13th Gen i7',
                'brand' => 'Dell',
                'price' => 317600,
                'processor' => 'Core i7 13th Gen',
                'ram' => '16GB DDR4',
                'storage' => '512GB SSD',
                'display' => '15.6" FHD',
                'warranty' => '1 Year',
                'stock_status' => 'in_stock',
                'stock_qty' => 8,
                'is_featured' => true,
                'description' => 'Reliable everyday laptop for work and study, with strong performance and a comfortable keyboard.',
            ],
            [
                'category_id' => $monitors?->id,
                'name' => 'G32C4X — 31.5" FHD 250Hz Curved',
                'brand' => 'MSI',
                'price' => 106000,
                'display' => '31.5" Curved FHD',
                'warranty' => '3 Years',
                'stock_status' => 'in_stock',
                'stock_qty' => 12,
                'is_featured' => true,
                'description' => 'High refresh-rate curved gaming monitor for immersive visuals and smooth gameplay.',
            ],
            [
                'category_id' => $networking?->id,
                'name' => 'DGS-F1026P-E — 24GE PoE Switch',
                'brand' => 'D-Link',
                'price' => 94500,
                'warranty' => '5 Years',
                'stock_status' => 'in_stock',
                'stock_qty' => 6,
                'is_featured' => true,
                'description' => '24-port Gigabit PoE switch with 2 SFP uplinks, ideal for office and CCTV network deployments.',
            ],
            [
                'category_id' => $printers?->id,
                'name' => 'ADS-3100 — Color Duplex Scanner',
                'brand' => 'Brother',
                'price' => 196500,
                'warranty' => '1 Year',
                'stock_status' => 'in_stock',
                'stock_qty' => 4,
                'is_featured' => false,
                'description' => 'Fast color duplex document scanner with automatic document feeder for busy offices.',
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['name' => $p['name']],
                $p
            );
        }
    }
}
